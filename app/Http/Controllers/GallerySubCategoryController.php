<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GallerySubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GallerySubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $subcategories = GallerySubCategory::with('category')
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('gallery_category_id'), fn($q) => $q->where('gallery_category_id', $request->gallery_category_id))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = GalleryCategory::orderBy('title')->get();

        return view('admin.gallery-subcategories.index', compact('subcategories', 'categories'));
    }

    public function create()
    {
        $categories = GalleryCategory::where('is_active', 1)->latest()->get();

        return view('admin.gallery-subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);


        $data['is_active'] = $request->has('is_active') ? 1 : 0;


        GallerySubCategory::create($data);

        return redirect()->route('admin.gallery-subcategories.index')
            ->with('success', 'Gallery sub category created successfully.');
    }

    public function edit(GallerySubCategory $gallery_subcategory)
    {
        $categories = GalleryCategory::where('is_active', 1)->latest()->get();

        return view('admin.gallery-subcategories.edit', [
            'subcategory' => $gallery_subcategory,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, GallerySubCategory $gallery_subcategory)
    {
        $data = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);


        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $gallery_subcategory->update($data);

        return redirect()->route('admin.gallery-subcategories.index')
            ->with('success', 'Gallery sub category updated successfully.');
    }

    public function destroy(GallerySubCategory $gallery_subcategory)
    {

        $gallery_subcategory->delete();

        return back()->with('success', 'Gallery sub category deleted successfully.');
    }
}
