<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GallerySubCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GalleryImageController extends Controller
{
    public function index(Request $request)
    {
        // Filtered to one category / event → default to the gallery display order,
        // so the list matches what the website shows (1 = big photo)
        $filtered = $request->filled('gallery_category_id') || $request->filled('gallery_sub_category_id');
        $sort = in_array($request->get('sort'), ['title', 'is_active', 'created_at', 'sort_order'])
            ? $request->get('sort')
            : ($filtered ? 'sort_order' : 'created_at');
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';
        if (!$request->filled('sort') && $sort === 'sort_order') {
            $direction = 'asc';
        }

        $images = GalleryImage::with(['category', 'subCategory'])
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('gallery_category_id'), fn($q) => $q->where('gallery_category_id', $request->gallery_category_id))
            ->when($request->filled('gallery_sub_category_id'), fn($q) => $q->where('gallery_sub_category_id', $request->gallery_sub_category_id))
            ->when($sort === 'sort_order' && $direction === 'asc',
                fn($q) => $q->displayOrder(),
                fn($q) => $q->orderBy($sort, $direction)->orderByDesc('id'))
            ->paginate(20)
            ->withQueryString();

        $categories = GalleryCategory::orderBy('title')->get();
        $subCategories = GallerySubCategory::orderBy('title')->get();

        return view('admin.gallery-images.index', compact('images', 'categories', 'subCategories', 'sort', 'direction'));
    }

    public function create()
    {
        $categories = GalleryCategory::where('is_active', 1)
            ->latest()
            ->get();

        return view('admin.gallery-images.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'gallery_sub_category_id' => [
                'nullable',
                Rule::exists('gallery_sub_categories', 'id')->where('gallery_category_id', $request->input('gallery_category_id')),
            ],
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_alt' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $path = public_path('uploads/gallery/images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filename = time() . '_' . Str::random(8) . '.' . $request->image->extension();

        $request->image->move($path, $filename);

        $data['image'] = 'uploads/gallery/images/' . $filename;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        GalleryImage::create($data);

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image added successfully.');
    }

    public function edit(GalleryImage $gallery_image)
    {
        $categories = GalleryCategory::where('is_active', 1)
            ->latest()
            ->get();

        $subcategories = GallerySubCategory::where('gallery_category_id', $gallery_image->gallery_category_id)
            ->where('is_active', 1)
            ->get();

        return view('admin.gallery-images.edit', [
            'image' => $gallery_image,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function update(Request $request, GalleryImage $gallery_image)
    {
        $data = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'gallery_sub_category_id' => [
                'nullable',
                Rule::exists('gallery_sub_categories', 'id')->where('gallery_category_id', $request->input('gallery_category_id')),
            ],
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_alt' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            if ($gallery_image->image && file_exists(public_path($gallery_image->image))) {
                unlink(public_path($gallery_image->image));
            }

            $path = public_path('uploads/gallery/images');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $filename = time() . '_' . Str::random(8) . '.' . $request->image->extension();

            $request->image->move($path, $filename);

            $data['image'] = 'uploads/gallery/images/' . $filename;
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $gallery_image->update($data);

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    /** Save the "Order" numbers typed in the image list (one click for many photos). */
    public function updateOrder(Request $request)
    {
        $data = $request->validate([
            'order' => 'required|array',
            'order.*' => 'nullable|integer|min:0|max:9999',
        ]);

        foreach ($data['order'] as $id => $order) {
            GalleryImage::whereKey((int) $id)->update(['sort_order' => (int) ($order ?? 0)]);
        }

        return back()->with('success', 'Image order saved.');
    }

    public function destroy(GalleryImage $gallery_image)
    {
        if ($gallery_image->image && file_exists(public_path($gallery_image->image))) {
            unlink(public_path($gallery_image->image));
        }

        $gallery_image->delete();

        return back()->with('success', 'Gallery image deleted successfully.');
    }

    public function getSubCategories($categoryId)
    {
        $subcategories = GallerySubCategory::where('gallery_category_id', $categoryId)
            ->where('is_active', 1)
            ->select('id', 'title')
            ->get();

        return response()->json($subcategories);
    }
    
}
