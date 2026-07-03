<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramCategoryController extends Controller
{
    public function index(Request $request)
    {
        $programCategories = ProgramCategory::query()
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('sort_order', 'asc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.program-categories.index', compact('programCategories'));
    }

    public function create()
    {
        $programCategory = null;
        return view('admin.program-categories.form', compact('programCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'icon'       => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'status'     => 'required|in:0,1',
        ]);

        $slug = Str::slug($request->title);
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if (!file_exists(public_path('images/program-categories'))) {
                mkdir(public_path('images/program-categories'), 0755, true);
            }
            $imagePath = 'images/program-categories/' . $slug . '.' . $ext;
            $file->move(public_path('images/program-categories'), $slug . '.' . $ext);
        }

        ProgramCategory::create([
            'title'      => $request->title,
            'slug'       => $slug,
            'icon'       => $request->icon,
            'image'      => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.program-categories.index')
            ->with('success', 'Program category added successfully');
    }

    public function edit(ProgramCategory $programCategory)
    {
        return view('admin.program-categories.form', compact('programCategory'));
    }

    public function update(Request $request, ProgramCategory $programCategory)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'icon'       => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'status'     => 'required|in:0,1',
        ]);

        $slug = Str::slug($request->title);
        $imagePath = $programCategory->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if (!file_exists(public_path('images/program-categories'))) {
                mkdir(public_path('images/program-categories'), 0755, true);
            }
            $imagePath = 'images/program-categories/' . $slug . '.' . $ext;
            $file->move(public_path('images/program-categories'), $slug . '.' . $ext);
        }

        $programCategory->update([
            'title'      => $request->title,
            'slug'       => $slug,
            'icon'       => $request->icon,
            'image'      => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.program-categories.index')
            ->with('success', 'Program category updated successfully');
    }

    public function destroy(ProgramCategory $programCategory)
    {
        $programCategory->delete();
        return back()->with('success', 'Program category deleted successfully');
    }
}
