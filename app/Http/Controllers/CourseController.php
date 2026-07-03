<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('category')
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('course_category_id'), fn($q) => $q->where('course_category_id', $request->course_category_id))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = CourseCategory::where('status', 1)->orderBy('sort_order', 'asc')->get();

        return view('admin.courses.index', compact('courses', 'categories'));
    }

    public function create()
    {
        $courses = CourseCategory::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('admin.courses.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_category_id' => 'required|exists:course_categories,id',
            'title' => 'required|max:255',
            'status' => 'required|in:0,1',
        ]);

        $course = Course::create([
            'course_category_id' => $request->course_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->slug ?? $request->title),
            'short_description' => $request->short_description,
            'banner_title' => $request->banner_title,
            'quote' => $request->quote,
            'duration_title_one' => $request->duration_title_one,
            'duration_one' => $request->duration_one,

            'duration_title_two' => $request->duration_title_two,
            'duration_two' => $request->duration_two,

            'duration_title_three' => $request->duration_title_three,
            'duration_three' => $request->duration_three,
            'eligibility' => $request->eligibility,
            'recognition' => $request->recognition,
            'placement_rate' => $request->placement_rate,
            'program_overview' => $request->program_overview,
            'about_course' => $request->about_course,
            'status' => $request->status,
        ]);

        $this->saveCourseExtraData($request, $course);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course added successfully');
    }

    public function edit(Course $course)
    {
        $course->load([
            'employmentOpportunities',
            'careerRoles',
            'graduatesWork',
            'faqs'
        ]);

        $coursecategories = CourseCategory::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('admin.courses.edit', compact('course', 'coursecategories'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_category_id' => 'required|exists:course_categories,id',
            'title' => 'required|max:255',
            'status' => 'required|in:0,1',
        ]);

        $course->update([
            'course_category_id' => $request->course_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->slug ?? $request->title),
            'short_description' => $request->short_description,
            'quote' => $request->quote,
            'duration_title_one' => $request->duration_title_one,
            'duration_one' => $request->duration_one,

            'duration_title_two' => $request->duration_title_two,
            'duration_two' => $request->duration_two,

            'duration_title_three' => $request->duration_title_three,
            'duration_three' => $request->duration_three,
            'eligibility' => $request->eligibility,
            'recognition' => $request->recognition,
            'placement_rate' => $request->placement_rate,
            'program_overview' => $request->program_overview,
            'about_course' => $request->about_course,
            'status' => $request->status,
        ]);

        $course->employmentOpportunities()->delete();
        $course->careerRoles()->delete();
        $course->graduatesWork()->delete();
        $course->faqs()->delete();

        $this->saveCourseExtraData($request, $course);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Course deleted successfully');
    }

    private function saveCourseExtraData(Request $request, Course $course)
    {
        if ($request->employment_opportunities) {
            foreach ($request->employment_opportunities as $title) {
                if (!empty($title)) {
                    $course->employmentOpportunities()->create([
                        'title' => $title
                    ]);
                }
            }
        }

        if ($request->career_roles) {
            foreach ($request->career_roles as $title) {
                if (!empty($title)) {
                    $course->careerRoles()->create([
                        'title' => $title
                    ]);
                }
            }
        }

        if ($request->graduates_work) {
            foreach ($request->graduates_work as $title) {
                if (!empty($title)) {
                    $course->graduatesWork()->create([
                        'title' => $title
                    ]);
                }
            }
        }

        if ($request->faqs) {
            foreach ($request->faqs as $faq) {

                if (!empty($faq['question'])) {

                    $course->faqs()->create([
                        'question' => $faq['question'],
                        'answer' => $faq['answer'] ?? null,
                    ]);
                }
            }
        }
    }
}
