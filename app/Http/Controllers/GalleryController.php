<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryCategory::query()
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.gallery-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.gallery-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:191|unique:gallery_categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $request->slug ?: Str::slug($request->title);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {

            $path = public_path('uploads/gallery/categories');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $filename = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();

            $request->image->move($path, $filename);

            $data['image'] = 'uploads/gallery/categories/' . $filename;
        }

        GalleryCategory::create($data);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category created successfully.');
    }

    public function edit(GalleryCategory $gallery_category)
    {
        return view('admin.gallery-categories.edit', [
            'category' => $gallery_category
        ]);
    }

    public function update(Request $request, GalleryCategory $gallery_category)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:191|unique:gallery_categories,slug,' . $gallery_category->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $request->slug ?: Str::slug($request->title);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {

            $path = public_path('uploads/gallery/categories');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $filename = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();

            $request->image->move($path, $filename);

            $data['image'] = 'uploads/gallery/categories/' . $filename;
        }
        $gallery_category->update($data);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category updated successfully.');
    }

    public function destroy(GalleryCategory $gallery_category)
    {
        if ($gallery_category->image && file_exists(public_path($gallery_category->image))) {
            unlink(public_path($gallery_category->image));
        }

        $gallery_category->delete();

        return back()->with('success', 'Gallery category deleted successfully.');
    }
}
