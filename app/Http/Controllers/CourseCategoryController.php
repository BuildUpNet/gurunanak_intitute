<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

   class CourseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $coursecategories = CourseCategory::query()
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('sort_order', 'asc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.course-categories.index', compact('coursecategories'));
    }

    public function create()
    {
        return view('admin.course-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'icon' => 'nullable|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        CourseCategory::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'slug' => Str::slug($request->slug ?? $request->title),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.course-categories.index')
            ->with('success', 'Category added successfully');
    }

    public function edit(CourseCategory $courseCategory)
    {
        return view('admin.course-categories.edit', compact('courseCategory'));
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $request->validate([
            'title' => 'required|max:255',
            'icon' => 'nullable|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $courseCategory->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'slug' => Str::slug($request->slug ?? $request->title),
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.course-categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}