<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\ProgramCategory;
use App\Models\ProgramDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProgramDetailController extends Controller
{
    public function index(Request $request)
    {
        $programs = ProgramDetail::with('school')
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('course_category_id'), fn($q) => $q->where('course_category_id', $request->course_category_id))
            ->when($request->filled('program_category_id'), fn($q) => $q->whereHas('levels', function ($q2) use ($request) {
                $q2->where('program_category_id', $request->program_category_id);
            }))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('sort_order')->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        $courseCategories = CourseCategory::orderBy('sort_order')->get();
        $programCategoryOptions = ProgramCategory::orderBy('sort_order')->get();

        return view('admin.program-details.index', compact('programs', 'courseCategories', 'programCategoryOptions'));
    }

    public function create()
    {
        $programCategories = ProgramCategory::where('status', 1)->orderBy('sort_order')->get();
        $courseCategories = CourseCategory::where('status', 1)->orderBy('sort_order')->get();
        return view('admin.program-details.form', [
            'program' => null,
            'programCategories' => $programCategories,
            'courseCategories' => $courseCategories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_category_id' => 'nullable|exists:course_categories,id',
            'slug'        => 'required|string|max:80|unique:program_details,slug|regex:/^[a-z0-9\-]+$/',
            'title'       => 'required|string|max:200',
            'short_name'  => 'nullable|string|max:20',
            'level'       => 'required|string|max:100',
            'locations'   => 'required|string|max:200',
            'quote'       => 'nullable|string',
            'overview_1'  => 'nullable|string',
            'overview_2'  => 'nullable|string',
            'overview_3'  => 'nullable|string',
            'overview_4'  => 'nullable|string',
            'eligibility' => 'nullable|string',
            'status'      => 'required|in:0,1',
            'sort_order'  => 'integer|min:0',
            'hero_image'  => 'nullable|image|max:2048',
            'cta_image'   => 'nullable|image|max:2048',
        ]);

        $data['duration'] = $this->firstLevelDuration($request->input('levels', []));
        $data = $this->handleImages($request, $data, $request->input('slug'));
        $program = ProgramDetail::create($data);
        $this->syncOpportunities($program, $request->input('opportunities', []));
        $this->syncLevels($program, $request->input('levels', []));
        $this->syncGlanceItems($program, $request->input('glance_items', []));
        $this->syncHeroBadges($program, $request->input('hero_badges', []));
        $this->syncCareerRoles($program, $request->input('career_roles', []));
        $this->syncGraduatesWork($program, $request->input('graduates_work', []));
        $this->syncFaqs($program, $request->input('faqs', []));

        return redirect()->route('admin.program-details.index')
            ->with('success', 'Program created successfully.');
    }

    public function edit(ProgramDetail $programDetail)
    {
        $programCategories = ProgramCategory::where('status', 1)->orderBy('sort_order')->get();
        $courseCategories = CourseCategory::where('status', 1)->orderBy('sort_order')->get();
        $programDetail->load('levels', 'heroBadges', 'glanceItems', 'careerRoles', 'graduatesWork', 'faqs');
        return view('admin.program-details.form', [
            'program' => $programDetail,
            'programCategories' => $programCategories,
            'courseCategories' => $courseCategories,
        ]);
    }

    public function update(Request $request, ProgramDetail $programDetail)
    {
        $data = $request->validate([
            'course_category_id' => 'nullable|exists:course_categories,id',
            'slug'        => ['required','string','max:80','regex:/^[a-z0-9\-]+$/',
                              Rule::unique('program_details','slug')->ignore($programDetail->id)],
            'title'       => 'required|string|max:200',
            'short_name'  => 'nullable|string|max:20',
            'level'       => 'required|string|max:100',
            'locations'   => 'required|string|max:200',
            'quote'       => 'nullable|string',
            'overview_1'  => 'nullable|string',
            'overview_2'  => 'nullable|string',
            'overview_3'  => 'nullable|string',
            'overview_4'  => 'nullable|string',
            'eligibility' => 'nullable|string',
            'status'      => 'required|in:0,1',
            'sort_order'  => 'integer|min:0',
            'hero_image'  => 'nullable|image|max:2048',
            'cta_image'   => 'nullable|image|max:2048',
        ]);

        $data['duration'] = $this->firstLevelDuration($request->input('levels', []));
        $data = $this->handleImages($request, $data, $request->input('slug'), $programDetail);
        $programDetail->update($data);
        $this->syncOpportunities($programDetail, $request->input('opportunities', []));
        $this->syncLevels($programDetail, $request->input('levels', []));
        $this->syncGlanceItems($programDetail, $request->input('glance_items', []));
        $this->syncHeroBadges($programDetail, $request->input('hero_badges', []));
        $this->syncCareerRoles($programDetail, $request->input('career_roles', []));
        $this->syncGraduatesWork($programDetail, $request->input('graduates_work', []));
        $this->syncFaqs($programDetail, $request->input('faqs', []));

        return redirect()->route('admin.program-details.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(ProgramDetail $programDetail)
    {
        $this->deleteImageFile($programDetail->hero_image);
        $this->deleteImageFile($programDetail->cta_image);
        $programDetail->delete();

        return redirect()->route('admin.program-details.index')
            ->with('success', 'Program deleted.');
    }

    private function handleImages(Request $request, array $data, string $slug, ?ProgramDetail $existing = null): array
    {
        $dir = public_path('images/programs');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach (['hero_image' => 'hero', 'cta_image' => 'cta'] as $field => $suffix) {
            if ($request->hasFile($field)) {
                // delete old
                if ($existing) {
                    $this->deleteImageFile($existing->$field);
                }
                $ext  = $request->file($field)->getClientOriginalExtension();
                $name = $slug . '-' . $suffix . '.' . $ext;
                $request->file($field)->move($dir, $name);
                $data[$field] = 'images/programs/' . $name;
            } elseif ($existing && $field === 'hero_image' && $request->boolean('remove_hero_image')) {
                // back to the shared default hero image
                $this->deleteImageFile($existing->hero_image);
                $data['hero_image'] = null;
            } elseif ($existing) {
                // keep existing path
                $data[$field] = $existing->$field;
            }
        }

        return $data;
    }

    /** Unlink an uploaded program image — the shared default hero image is never deleted. */
    private function deleteImageFile(?string $path): void
    {
        if (! $path || $path === ProgramDetail::DEFAULT_HERO_IMAGE) {
            return;
        }
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    private function syncOpportunities(ProgramDetail $program, array $rows): void
    {
        $program->opportunities()->delete();
        $i = 0;
        foreach ($rows as $row) {
            $title = trim($row['title'] ?? '');
            if ($title === '') continue;
            $program->opportunities()->create([
                'icon'       => trim($row['icon'] ?? 'fas fa-briefcase'),
                'title'      => $title,
                'sort_order' => $i++,
            ]);
        }
    }

    private function firstLevelDuration(array $rows): ?string
    {
        foreach ($rows as $row) {
            $duration = trim($row['duration'] ?? '');
            if ($duration !== '') return $duration;
        }
        return null;
    }

    private function syncLevels(ProgramDetail $program, array $rows): void
    {
        $program->levels()->delete();
        $i = 0;
        foreach ($rows as $row) {
            $categoryId = $row['program_category_id'] ?? '';
            $duration   = trim($row['duration'] ?? '');
            if ($categoryId === '' || $duration === '') continue;
            $program->levels()->create([
                'program_category_id' => $categoryId,
                'duration'            => $duration,
                'sort_order'          => $i++,
            ]);
        }
    }

    private function syncHeroBadges(ProgramDetail $program, array $rows): void
    {
        $program->heroBadges()->delete();
        $i = 0;
        foreach ($rows as $row) {
            $text = trim($row['text'] ?? '');
            if ($text === '') continue;
            $program->heroBadges()->create([
                'icon'       => trim($row['icon'] ?? '') ?: 'fas fa-check-circle',
                'text'       => $text,
                'sort_order' => $i++,
            ]);
        }
    }

    private function syncGlanceItems(ProgramDetail $program, array $rows): void
    {
        $program->glanceItems()->delete();
        $i = 0;
        foreach ($rows as $row) {
            $degree      = trim($row['degree'] ?? '');
            $duration    = trim($row['duration'] ?? '');
            $eligibility = trim($row['eligibility'] ?? '');
            if ($degree === '' || $duration === '') continue;
            $program->glanceItems()->create([
                'degree'      => $degree,
                'duration'    => $duration,
                'eligibility' => $eligibility !== '' ? $eligibility : null,
                'sort_order'  => $i++,
            ]);
        }
    }

    private function syncCareerRoles(ProgramDetail $program, array $rows): void
    {
        $program->careerRoles()->delete();
        $i = 0;
        foreach ($rows as $title) {
            $title = trim($title);
            if ($title === '') continue;
            $program->careerRoles()->create(['title' => $title, 'sort_order' => $i++]);
        }
    }

    private function syncGraduatesWork(ProgramDetail $program, array $rows): void
    {
        $program->graduatesWork()->delete();
        $i = 0;
        foreach ($rows as $title) {
            $title = trim($title);
            if ($title === '') continue;
            $program->graduatesWork()->create(['title' => $title, 'sort_order' => $i++]);
        }
    }

    private function syncFaqs(ProgramDetail $program, array $rows): void
    {
        $program->faqs()->delete();
        $i = 0;
        foreach ($rows as $row) {
            $question = trim($row['question'] ?? '');
            $answer   = trim($row['answer'] ?? '');
            if ($question === '' || $answer === '') continue;
            $program->faqs()->create(['question' => $question, 'answer' => $answer, 'sort_order' => $i++]);
        }
    }
}
