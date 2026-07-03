<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\ProgramCategory;
use App\Models\ProgramDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateCoursesToPrograms extends Command
{
    protected $signature = 'app:migrate-courses-to-programs {--dry-run : Show what would happen without writing anything}';

    protected $description = 'One-off: migrate the old Departments (courses) data into the Programs system, per doc/programs.xlsx and doc/SCHOOLS.xlsx';

    /** Schools per SCHOOLS.xlsx, in Sr.no order. Each: [old_title_to_rename (or null if new), final_title] */
    const SCHOOL_TARGETS = [
        ['old' => 'School of Allied Health Sciences', 'new' => 'School of Allied Health Sciences'],
        ['old' => 'School of Physiotherapy and Radiology', 'new' => 'School of Physiotherapy and Radiology'],
        ['old' => 'School of Healthcare Management & Community Health', 'new' => 'School of Hospital & Healthcare Management'],
        ['old' => null, 'new' => 'School of Nursing Sciences'],
        ['old' => 'School of Dental Sciences', 'new' => 'School of Dental Sciences'],
        ['old' => null, 'new' => 'School of Pharmacy & Medical Assistance'],
        ['old' => 'School of Ayurveda & Wellness Sciences', 'new' => 'School of Ayurveda'],
        ['old' => 'School of Humanities & Social Sciences', 'new' => 'School of Arts, Humanities & Languages'],
        ['old' => 'School of Management & Commerce', 'new' => 'School of Commerce & Management'],
        ['old' => 'School of Design & Fashion Technology', 'new' => 'School of Design & Creative Arts'],
        ['old' => 'School of Library & Information Sciences', 'new' => 'School of Library & Information Science'],
        ['old' => 'School of Journalism & Mass Communication', 'new' => 'School of Journalism & Mass Communication'],
        ['old' => 'School of Computer Applications', 'new' => 'School of Computer Applications'],
        ['old' => 'School of Hospitality, Tourism & Travel Management', 'new' => 'School of Tourism and Hospitality Service Management'],
    ];

    /** courses.id => final School title (only for courses that move to a DIFFERENT school than their current one) */
    const COURSE_SCHOOL_MOVES = [
        1  => 'School of Physiotherapy and Radiology',   // Physiotherapy
        3  => 'School of Physiotherapy and Radiology',   // Radiology & Medical Imaging Technology
        8  => 'School of Hospital & Healthcare Management', // Emergency & Trauma Care
        9  => 'School of Hospital & Healthcare Management', // Critical Care Management
        11 => 'School of Nursing Sciences',              // CMS & ED
        14 => 'School of Nursing Sciences',               // Patient Care Management
        16 => 'School of Nursing Sciences',               // Health & Sanitary Inspector
        17 => 'School of Nursing Sciences',               // Multipurpose Health Worker
        18 => 'School of Nursing Sciences',               // Community Care Provider
        19 => 'School of Nursing Sciences',               // Home Care Provider
        20 => 'School of Nursing Sciences',               // Nanny Training
    ];

    /** SCHOOLS.xlsx: school title => [course title (normalized-matchable) => ranking] */
    const SCHOOL_RANKINGS = [
        'School of Allied Health Sciences' => [
            'Operation Theatre & Anaesthesia Technology' => 1, 'Medical Lab Technology' => 2, 'Optometry Technology' => 3,
            'Dialysis Technology' => 4, 'Hospital Sterilization Technology' => 5, 'Cath Lab Technician' => 6,
            'Cardiac Care Technology' => 7, 'CT Scan Assistant' => 8, 'Echocardiography Technician (ECG)' => 9,
            'MRI Technician' => 10, 'EEG & Neurology Technician' => 11, 'Central Sterile Services Department (CSSD)' => 12,
        ],
        'School of Physiotherapy and Radiology' => [
            'Physiotherapy' => 1, 'Radiology & Medical Imaging Technology' => 2,
        ],
        'School of Hospital & Healthcare Management' => [
            'Hospital Management' => 1, 'Hospital Administration' => 2, 'Critical Care Management' => 3,
            'Emergency & Trauma Care' => 4, 'Hospital Waste Management' => 5, 'Accident & Emergency Care' => 6,
        ],
        'School of Nursing Sciences' => [
            'Multipurpose Health Worker' => 1, 'CMS & ED' => 2, 'Nanny Training' => 3, 'Patient Care Management' => 4,
            'Health & Sanitary Inspector' => 5, 'Community Care Provider' => 6, 'Home Care Provider' => 7, 'Child Education' => 8,
        ],
        'School of Dental Sciences' => [
            'Dental Chair Side Assistant' => 1, 'Dental Assistant' => 2,
        ],
        'School of Pharmacy & Medical Assistance' => [
            'Medical Assistant Pharmacist' => 1,
        ],
        'School of Ayurveda' => [
            'Panchkarma Technician' => 1,
        ],
        'School of Arts, Humanities & Languages' => [
            'Bachelor of Arts (BA)' => 1, 'Master of Arts in Hindi' => 2, 'Master of Arts in Punjabi' => 3,
            'Master of Arts in Political Science' => 4, 'Master of Arts in History' => 5, 'Master of Arts in English' => 6,
        ],
        'School of Commerce & Management' => [
            'Bachelor of Business Administration (BBA)' => 1, 'Bachelor of Commerce (B.Com.)' => 2,
            'Master of Commerce (M.Com.)' => 3, 'Master of Business Administration (MBA)' => 4,
        ],
        'School of Design & Creative Arts' => [
            'Fashion Technology' => 1, 'Textile Designing' => 2, 'Interior Designing' => 3,
        ],
        'School of Library & Information Science' => [
            'Master of Library and Information Science (MLISc)' => 1,
        ],
        'School of Journalism & Mass Communication' => [
            'Master of Journalism and Mass Communication (MJMC)' => 1,
        ],
        'School of Computer Applications' => [
            'Master of Computer Applications (MCA)' => 1,
        ],
        'School of Tourism and Hospitality Service Management' => [
            'Master of Tourism and Travel Management (MTTM)' => 1,
        ],
    ];

    /** 3 brand-new courses with no existing content — created as drafts. [title, short_name, school, level] */
    const NEW_DRAFT_COURSES = [
        ['title' => 'Accident & Emergency Care', 'short_name' => 'AEC', 'school' => 'School of Hospital & Healthcare Management', 'level' => 'Diploma'],
        ['title' => 'Child Education', 'short_name' => 'CE', 'school' => 'School of Nursing Sciences', 'level' => 'Diploma'],
        ['title' => 'Medical Assistant Pharmacist', 'short_name' => 'MAP', 'school' => 'School of Pharmacy & Medical Assistance', 'level' => 'Diploma'],
    ];

    /** programs.xlsx block order, mapped to the EXACT titles already in the live program_categories table => sort_order */
    const PROGRAM_CATEGORY_ORDER = [
        'Undergraduate' => 1,
        'Post Graduate' => 2,
        'Diploma ( I and II year )' => 3,
        '1oth based diploma' => 4,
        'Online courses' => 5,
        'OPEN DISTANCE LEARNING' => 6,
        '6 months certificate' => 7,
    ];

    /** programs.xlsx rows, in file order: [category, course title (matchable), duration] */
    const PROGRAM_LEVEL_ROWS = [
        // Undergraduate
        ['Undergraduate', 'Cardiac Care Technology', '3 Year'],
        ['Undergraduate', 'Dialysis Technology', '3 Year'],
        ['Undergraduate', 'Fashion Technology', '3 Year'],
        ['Undergraduate', 'Hospital Management', '3 Year'],
        ['Undergraduate', 'Hospital Sterilization Technology', '3 Year'],
        ['Undergraduate', 'Interior Designing', '3 Year'],
        ['Undergraduate', 'Medical Lab Technology', '3 Year'],
        ['Undergraduate', 'Optometry Technology', '3 Year'],
        ['Undergraduate', 'Patient Care Management', '3 Year'],
        ['Undergraduate', 'Physiotherapy', '3 Year'],
        ['Undergraduate', 'Radiology & Medical Imaging Technology', '3 Year'],
        ['Undergraduate', 'Textile Designing', '3 Year'],
        ['Undergraduate', 'CMS & ED', '3 Year'],
        ['Undergraduate', 'Operation Theatre & Anaesthesia Technology', '3 Year'],
        ['Undergraduate', 'Bachelor of Business Administration (BBA)', '3 Year'],
        ['Undergraduate', 'Bachelor of Commerce (B.Com.)', '3 Year'],
        ['Undergraduate', 'Bachelor of Arts (BA)', '3 Year'],
        // Postgraduate
        ['Post Graduate','Cardiac Care Technology', '2 Years'],
        ['Post Graduate','Dialysis Technology', '2 Years'],
        ['Post Graduate','Fashion Technology', '2 Years'],
        ['Post Graduate','Interior Designing', '2 Years'],
        ['Post Graduate','Medical Lab Technology', '2 Years'],
        ['Post Graduate','Optometry Technology', '2 Years'],
        ['Post Graduate','Radiology & Medical Imaging Technology', '2 Years'],
        ['Post Graduate','Textile Designing', '2 Years'],
        ['Post Graduate','Operation Theatre & Anaesthesia Technology', '2 Years'],
        ['Post Graduate','Master of Business Administration (MBA)', '2 Years'],
        ['Post Graduate','Master of Tourism and Travel Management (MTTM)', '2 Years'],
        ['Post Graduate','Master of Computer Applications (MCA)', '2 Years'],
        ['Post Graduate','Master of Commerce (M.Com.)', '2 Years'],
        ['Post Graduate','Master of Library and Information Science (MLISc)', '2 Years'],
        ['Post Graduate','Master of Journalism and Mass Communication (MJMC)', '2 Years'],
        ['Post Graduate','Master of Arts in English', '2 Years'],
        ['Post Graduate','Master of Arts in Political Science', '2 Years'],
        ['Post Graduate','Master of Arts in History', '2 Years'],
        // Diploma
        ['Diploma ( I and II year )','Cardiac Care Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Dialysis Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Fashion Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Hospital Management', '1 and 2 year'],
        ['Diploma ( I and II year )','Hospital Sterilization Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Interior Designing', '1 and 2 year'],
        ['Diploma ( I and II year )','Medical Lab Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Optometry Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Patient Care Management', '1 and 2 year'],
        ['Diploma ( I and II year )','Physiotherapy', '1 and 2 year'],
        ['Diploma ( I and II year )','Radiology & Medical Imaging Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Textile Designing', '1 and 2 year'],
        ['Diploma ( I and II year )','CMS & ED', '1 and 2 year'],
        ['Diploma ( I and II year )','Operation Theatre & Anaesthesia Technology', '1 and 2 year'],
        ['Diploma ( I and II year )','Multipurpose Health Worker', '1 and 2 year'],
        ['Diploma ( I and II year )','Critical Care Management', '1 Year'],
        ['Diploma ( I and II year )','Dental Chair Side Assistant', '1 Year'],
        ['Diploma ( I and II year )','Community Care Provider', '1 Year'],
        ['Diploma ( I and II year )','Emergency & Trauma Care', '1 Year'],
        ['Diploma ( I and II year )','Health & Sanitary Inspector', '1 Year'],
        ['Diploma ( I and II year )','Home Care Provider', '1 Year'],
        ['Diploma ( I and II year )','Hospital Administration', '1 Year'],
        ['Diploma ( I and II year )','Hospital Waste Management', '1 Year'],
        ['Diploma ( I and II year )','Nanny Training', '1 Year'],
        ['Diploma ( I and II year )','Panchkarma Technician', '1 Year'],
        // 10th based diploma
        ['1oth based diploma','Dialysis Technology', '3 Year'],
        ['1oth based diploma','Operation Theatre & Anaesthesia Technology', '3 Year'],
        ['1oth based diploma','Medical Lab Technology', '3 Year'],
        // Online courses
        ['Online courses', 'Bachelor of Business Administration (BBA)', '3 Years'],
        ['Online courses', 'Bachelor of Commerce (B.Com.)', '3 Years'],
        ['Online courses', 'Bachelor of Arts (BA)', '3 Years'],
        ['Online courses', 'Master of Computer Applications (MCA)', '2 Years'],
        ['Online courses', 'Master of Commerce (M.Com.)', '2 Years'],
        ['Online courses', 'Master of Business Administration (MBA)', '2 Years'],
        ['Online courses', 'Master of Library and Information Science (MLISc)', '2 Years'],
        ['Online courses', 'Master of Journalism and Mass Communication (MJMC)', '2 Years'],
        ['Online courses', 'Master of Arts in English', '2 Years'],
        ['Online courses', 'Master of Arts in Political Science', '2 Years'],
        ['Online courses', 'Master of Arts in History', '2 Years'],
        // Open Distance Learning
        ['OPEN DISTANCE LEARNING','Master of Business Administration (MBA)', '2 Years'],
        ['OPEN DISTANCE LEARNING','Master of Arts in English', '2 Years'],
        ['OPEN DISTANCE LEARNING','Master of Commerce (M.Com.)', '2 Years'],
        ['OPEN DISTANCE LEARNING','Bachelor of Business Administration (BBA)', '3 Years'],
        ['OPEN DISTANCE LEARNING','Bachelor of Arts (BA)', '3 Years'],
        ['OPEN DISTANCE LEARNING','Master of Tourism and Travel Management (MTTM)', '2 Years'],
        // 6 months certificate
        ['6 months certificate', 'Operation Theatre & Anaesthesia Technology', '6 Months'],
        ['6 months certificate', 'Medical Lab Technology', '6 Months'],
        ['6 months certificate', 'Radiology & Medical Imaging Technology', '6 Months'],
        ['6 months certificate', 'Panchkarma Technician', '6 Months'],
    ];

    private function normalize(string $s): string
    {
        $s = strtoupper($s);
        $s = preg_replace('/[().,&\/]/', ' ', $s);
        $s = preg_replace('/\bAND\b/', ' ', $s);
        $s = preg_replace('/\s+/', ' ', trim($s));
        return $s;
    }

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $this->info($dryRun ? 'DRY RUN — no changes will be written.' : 'Running migration...');

        DB::beginTransaction();
        try {
            // ── Step 1: Schools — rename existing, create new ──
            $schoolIdByTitle = [];
            foreach (self::SCHOOL_TARGETS as $i => $target) {
                if ($target['old']) {
                    $school = CourseCategory::where('title', $target['old'])->first();
                    if (!$school) {
                        $this->warn("School not found by old title '{$target['old']}' — skipping rename.");
                        continue;
                    }
                    $school->update(['title' => $target['new'], 'sort_order' => $i + 1]);
                } else {
                    $school = CourseCategory::create([
                        'title' => $target['new'],
                        'slug' => Str::slug($target['new']),
                        'status' => 1,
                        'sort_order' => $i + 1,
                    ]);
                }
                $schoolIdByTitle[$target['new']] = $school->id;
            }
            $this->info('Schools: ' . count($schoolIdByTitle) . ' in place.');

            // Remove duplicate empty Program Category "Certificate program ( 6 months)" if present and unused
            $dup = ProgramCategory::where('title', 'LIKE', 'Certificate program%')->first();
            if ($dup && $dup->programDetails()->count() === 0) {
                $dup->delete();
                $this->info('Removed duplicate empty Program Category: ' . $dup->title);
            }

            // ── Step 2: Program Category sort order ──
            foreach (self::PROGRAM_CATEGORY_ORDER as $title => $order) {
                $cat = ProgramCategory::where('title', $title)->first();
                if ($cat) {
                    $cat->update(['sort_order' => $order]);
                } else {
                    $this->warn("Program Category not found: '$title'");
                }
            }
            $programCategoryIdByNorm = [];
            foreach (ProgramCategory::all() as $cat) {
                $programCategoryIdByNorm[$this->normalize($cat->title)] = $cat->id;
            }

            // ── Step 3: build normalized lookup of programs.xlsx rows, grouped by course ──
            $levelsByNormCourse = [];
            $sortCounters = [];
            foreach (self::PROGRAM_LEVEL_ROWS as [$catTitle, $courseTitle, $duration]) {
                $normCat = $this->normalize($catTitle);
                $catId = $programCategoryIdByNorm[$normCat] ?? null;
                if (!$catId) {
                    $this->warn("Program Category not resolvable for row: $catTitle / $courseTitle");
                    continue;
                }
                $normCourse = $this->normalize($courseTitle);
                $sortCounters[$normCat] = ($sortCounters[$normCat] ?? -1) + 1;
                $levelsByNormCourse[$normCourse][] = [
                    'program_category_id' => $catId,
                    'duration' => $duration,
                    'sort_order' => $sortCounters[$normCat],
                ];
            }

            // ── Step 4: build normalized ranking lookup ──
            $rankingByNormCourse = [];
            foreach (self::SCHOOL_RANKINGS as $schoolTitle => $courses) {
                foreach ($courses as $courseTitle => $rank) {
                    $rankingByNormCourse[$this->normalize($courseTitle)] = $rank;
                }
            }

            // ── Step 5: migrate each of the 46 courses ──
            $created = 0; $skipped = 0; $noLevelsMatched = [];
            foreach (Course::with(['category', 'employmentOpportunities', 'careerRoles', 'graduatesWork', 'faqs'])->get() as $course) {
                $targetSchoolTitle = self::COURSE_SCHOOL_MOVES[$course->id] ?? null;
                if ($targetSchoolTitle) {
                    $schoolId = $schoolIdByTitle[$targetSchoolTitle] ?? null;
                } else {
                    // stays in its current school — renamed in place in Step 1, so the id is unchanged
                    $schoolId = $course->course_category_id;
                }
                if (!$schoolId) {
                    $this->warn("Could not resolve target School for course id={$course->id} '{$course->title}' — skipped.");
                    $skipped++;
                    continue;
                }

                $normCourse = $this->normalize($course->title);
                $sortOrder = $rankingByNormCourse[$normCourse] ?? 999;

                $overviewParts = array_filter([
                    $course->about_course,
                    $course->program_overview,
                ]);
                $durationNote = trim(implode(' · ', array_filter([
                    $course->duration_title_one && $course->duration_one ? "{$course->duration_title_one}: {$course->duration_one}" : null,
                    $course->duration_title_two && $course->duration_two ? "{$course->duration_title_two}: {$course->duration_two}" : null,
                    $course->duration_title_three && $course->duration_three ? "{$course->duration_title_three}: {$course->duration_three}" : null,
                ])));

                $slug = $course->slug;
                if (ProgramDetail::where('slug', $slug)->exists()) {
                    $slug = $slug . '-prog';
                }

                if (!$dryRun) {
                    $program = ProgramDetail::create([
                        'course_category_id' => $schoolId,
                        'slug' => $slug,
                        'title' => $course->title,
                        'short_name' => Str::limit($course->badge ?? $course->title, 18, ''),
                        'school_name' => CourseCategory::find($schoolId)->title,
                        'level' => $course->recognition ?: 'Program',
                        'duration' => $levelsByNormCourse[$normCourse][0]['duration'] ?? ($course->duration_one ?: 'Varies'),
                        'locations' => 'Patiala & Karnal',
                        'quote' => $course->quote,
                        'overview_1' => $overviewParts[0] ?? null,
                        'overview_2' => $overviewParts[1] ?? null,
                        'overview_3' => $durationNote ?: null,
                        'eligibility' => $course->eligibility,
                        'status' => $course->status,
                        'sort_order' => $sortOrder,
                    ]);

                    foreach ($levelsByNormCourse[$normCourse] ?? [] as $lvl) {
                        $program->levels()->create($lvl);
                    }
                    foreach ($course->employmentOpportunities as $i => $opp) {
                        $program->opportunities()->create(['icon' => 'fas fa-briefcase', 'title' => $opp->title, 'sort_order' => $i]);
                    }
                    foreach ($course->careerRoles as $i => $role) {
                        $program->careerRoles()->create(['title' => $role->title, 'sort_order' => $i]);
                    }
                    foreach ($course->graduatesWork as $i => $work) {
                        $program->graduatesWork()->create(['title' => $work->title, 'sort_order' => $i]);
                    }
                    foreach ($course->faqs as $i => $faq) {
                        $program->faqs()->create(['question' => $faq->question, 'answer' => $faq->answer, 'sort_order' => $i]);
                    }
                }

                if (empty($levelsByNormCourse[$normCourse])) {
                    $noLevelsMatched[] = $course->title;
                }
                $created++;
            }

            // ── Step 6: create the 3 brand-new draft courses ──
            foreach (self::NEW_DRAFT_COURSES as $draft) {
                $schoolId = $schoolIdByTitle[$draft['school']] ?? null;
                if (!$schoolId) {
                    $this->warn("New draft course '{$draft['title']}': School not found.");
                    continue;
                }
                $normCourse = $this->normalize($draft['title']);
                $sortOrder = $rankingByNormCourse[$normCourse] ?? 999;
                $slug = Str::slug($draft['title']);
                if (!$dryRun) {
                    ProgramDetail::create([
                        'course_category_id' => $schoolId,
                        'slug' => $slug,
                        'title' => $draft['title'],
                        'short_name' => $draft['short_name'],
                        'school_name' => $draft['school'],
                        'level' => $draft['level'],
                        'duration' => 'TBD',
                        'locations' => 'Patiala & Karnal',
                        'status' => 0,
                        'sort_order' => $sortOrder,
                    ]);
                }
                $this->info("Created draft course: {$draft['title']} (status=inactive, needs content)");
            }

            if ($dryRun) {
                DB::rollBack();
                $this->info("DRY RUN complete — would have created $created program(s), skipped $skipped.");
            } else {
                DB::commit();
                $this->info("Migration complete — created $created program(s), skipped $skipped, plus 3 draft courses.");
            }

            if ($noLevelsMatched) {
                $this->warn('Courses with NO matching Program Category/Duration level found in programs.xlsx (add manually via admin):');
                foreach (array_unique($noLevelsMatched) as $t) {
                    $this->line("  - $t");
                }
            }

            return self::SUCCESS;
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('Migration failed, rolled back: ' . $e->getMessage());
            $this->error($e->getFile() . ':' . $e->getLine());
            return self::FAILURE;
        }
    }
}
