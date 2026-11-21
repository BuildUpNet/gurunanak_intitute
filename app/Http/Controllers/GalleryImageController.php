<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GallerySubCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GalleryImageController extends Controller
{
    /**
     * Photo groups: one row per sub category (max 8 photos) + one row per category
     * for photos without a sub category. Each row opens the group editor.
     */
    public function index(Request $request)
    {
        $categoryId = $request->integer('gallery_category_id') ?: null;
        $search = trim((string) $request->get('search', ''));

        $categories = GalleryCategory::orderBy('title')->get();
        $catsById = $categories->keyBy('id');

        $images = GalleryImage::when($categoryId, fn($q) => $q->where('gallery_category_id', $categoryId))
            ->displayOrder()
            ->get();
        $byGroup = $images->groupBy(fn($img) => $img->gallery_category_id . '-' . (int) $img->gallery_sub_category_id);

        $groups = collect();

        // Photos with no sub category: one group per category
        foreach ($catsById as $cat) {
            $items = $byGroup->get($cat->id . '-0');
            if ($items && $items->count()) {
                $groups->push($this->makeGroup($cat, null, $items));
            }
        }

        // Every sub category (also empty ones, so photos can be added from the list)
        $subs = GallerySubCategory::when($categoryId, fn($q) => $q->where('gallery_category_id', $categoryId))
            ->orderByRaw('event_date IS NULL')
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->get();
        foreach ($subs as $sub) {
            $cat = $catsById->get($sub->gallery_category_id);
            if ($cat) {
                $groups->push($this->makeGroup($cat, $sub, $byGroup->get($sub->gallery_category_id . '-' . $sub->id, collect())));
            }
        }

        if ($search !== '') {
            $needle = Str::lower($search);
            $groups = $groups->filter(fn($g) => Str::contains(
                Str::lower($g->category->title . ' ' . ($g->sub->title ?? '') . ' ' . ($g->sub->heading ?? '')),
                $needle
            ));
        }

        // Category A–Z, its own photos first, then its sub categories (stable sort keeps date order)
        $groups = $groups->sortBy([
            fn($a, $b) => strcasecmp($a->category->title, $b->category->title),
            fn($a, $b) => ($a->sub ? 1 : 0) <=> ($b->sub ? 1 : 0),
        ])->values();

        $page = max(1, $request->integer('page', 1));
        $perPage = 10;
        $groups = new LengthAwarePaginator(
            $groups->forPage($page, $perPage)->values(),
            $groups->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.gallery-images.index', compact('groups', 'categories'));
    }

    private function makeGroup(GalleryCategory $category, ?GallerySubCategory $sub, $items): object
    {
        return (object) [
            'category' => $category,
            'sub' => $sub,
            'images' => $items->values(),
            'inactive' => $items->where('is_active', 0)->count(),
            'url' => route('admin.gallery-images.group', [$category->id, $sub->id ?? 0]),
        ];
    }

    /** Group editor: all photos of one sub category (or of a category without sub category) on one page. */
    public function editGroup(GalleryCategory $category, int $sub)
    {
        $subCategory = $this->groupSub($category, $sub);
        $images = $this->groupQuery($category, $subCategory)->displayOrder()->get();

        return view('admin.gallery-images.group', [
            'category' => $category,
            'subCategory' => $subCategory,
            'images' => $images,
            'maxImages' => GallerySubCategory::MAX_IMAGES,
        ]);
    }

    /** Save every photo of the group at once: alt, order, active, replace, remove + new photos. */
    public function updateGroup(Request $request, GalleryCategory $category, int $sub)
    {
        $subCategory = $this->groupSub($category, $sub);
        $max = GallerySubCategory::MAX_IMAGES;

        $request->validate([
            'photos' => 'nullable|array',
            'photos.*.alt' => 'nullable|string|max:255',
            'photos.*.order' => 'nullable|integer|min:0|max:9999',
            'photos.*.active' => 'nullable|boolean',
            'photos.*.delete' => 'nullable|boolean',
            'photos.*.file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images' => 'nullable|array|max:' . $max,
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'alts' => 'nullable|array',
            'alts.*' => 'nullable|string|max:255',
            'orders' => 'nullable|array',
            'orders.*' => 'nullable|integer|min:0|max:9999',
        ], [
            'images.max' => 'You can upload max ' . $max . ' photos at once.',
        ], [
            'photos.*.file' => 'replacement photo',
            'photos.*.alt' => 'alt text',
            'photos.*.order' => 'display order',
            'images.*' => 'new photo',
            'alts.*' => 'alt text',
            'orders.*' => 'display order',
        ]);

        $existing = $this->groupQuery($category, $subCategory)->get()->keyBy('id');
        $input = $request->input('photos', []);
        $newFiles = array_values($request->file('images', []));

        $removeIds = collect($input)->filter(fn($p) => !empty($p['delete']))->keys()
            ->map(fn($id) => (int) $id)->filter(fn($id) => $existing->has($id))->values();
        $kept = $existing->count() - $removeIds->count();

        if ($subCategory && $kept + count($newFiles) > $max) {
            throw ValidationException::withMessages([
                'images' => "A sub category can hold max {$max} photos. After this save it would have "
                    . ($kept + count($newFiles)) . '. Remove some photos first.',
            ]);
        }

        $dir = public_path('uploads/gallery/images');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        $saveFile = function ($file) use ($dir) {
            $filename = time() . '_' . Str::random(8) . '.' . $file->extension();
            $file->move($dir, $filename);
            return 'uploads/gallery/images/' . $filename;
        };

        $removed = $updated = 0;
        foreach ($existing as $id => $image) {
            if ($removeIds->contains($id)) {
                $this->deleteFile($image->image);
                $image->delete();
                $removed++;
                continue;
            }

            if (!array_key_exists($id, $input)) {
                continue;
            }
            $row = $input[$id];

            $image->image_alt = ($row['alt'] ?? '') !== '' ? $row['alt'] : null;
            $image->sort_order = (int) ($row['order'] ?? 0);
            $image->is_active = !empty($row['active']) ? 1 : 0;

            if ($request->hasFile("photos.$id.file")) {
                $old = $image->image;
                $image->image = $saveFile($request->file("photos.$id.file"));
                $this->deleteFile($old);
            }

            if ($image->isDirty()) {
                $image->save();
                $updated++;
            }
        }

        $alts = $request->input('alts', []);
        $orders = $request->input('orders', []);
        foreach ($newFiles as $i => $file) {
            GalleryImage::create([
                'gallery_category_id' => $category->id,
                'gallery_sub_category_id' => $subCategory->id ?? null,
                'image' => $saveFile($file),
                'image_alt' => $alts[$i] ?? null,
                'sort_order' => (int) ($orders[$i] ?? 0),
                'is_active' => 1,
            ]);
        }

        $parts = array_filter([
            $updated ? "{$updated} updated" : null,
            count($newFiles) ? count($newFiles) . ' added' : null,
            $removed ? "{$removed} removed" : null,
        ]);

        return redirect()
            ->route('admin.gallery-images.group', [$category->id, $subCategory->id ?? 0])
            ->with('success', $parts ? 'Photos saved: ' . implode(', ', $parts) . '.' : 'No changes to save.');
    }

    /** Sub category of a group URL (0 = photos without a sub category). */
    private function groupSub(GalleryCategory $category, int $sub): ?GallerySubCategory
    {
        if ($sub === 0) {
            return null;
        }

        return GallerySubCategory::where('gallery_category_id', $category->id)->findOrFail($sub);
    }

    private function groupQuery(GalleryCategory $category, ?GallerySubCategory $sub)
    {
        return GalleryImage::where('gallery_category_id', $category->id)
            ->when($sub, fn($q) => $q->where('gallery_sub_category_id', $sub->id),
                fn($q) => $q->whereNull('gallery_sub_category_id'));
    }

    private function deleteFile(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
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
        $max = GallerySubCategory::MAX_IMAGES;

        $data = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'gallery_sub_category_id' => [
                'nullable',
                Rule::exists('gallery_sub_categories', 'id')->where('gallery_category_id', $request->input('gallery_category_id')),
            ],
            'images' => 'required|array|min:1|max:' . $max,
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'alts' => 'nullable|array',
            'alts.*' => 'nullable|string|max:255',
            'orders' => 'nullable|array',
            'orders.*' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'nullable|boolean',
        ], [
            'images.required' => 'Please choose at least 1 photo.',
            'images.max' => 'You can upload max ' . $max . ' photos at once.',
        ], [
            'images.*' => 'photo',
            'alts.*' => 'alt text',
            'orders.*' => 'display order',
        ]);

        $files = array_values($request->file('images'));
        $this->ensureSubCategoryHasRoom($data['gallery_sub_category_id'] ?? null, null, count($files));

        $path = public_path('uploads/gallery/images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $alts = $request->input('alts', []);
        $orders = $request->input('orders', []);

        foreach ($files as $i => $file) {
            $filename = time() . '_' . Str::random(8) . '.' . $file->extension();
            $file->move($path, $filename);

            GalleryImage::create([
                'gallery_category_id' => $data['gallery_category_id'],
                'gallery_sub_category_id' => $data['gallery_sub_category_id'] ?? null,
                'image' => 'uploads/gallery/images/' . $filename,
                'image_alt' => $alts[$i] ?? null,
                'sort_order' => (int) ($orders[$i] ?? 0),
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]);
        }

        $n = count($files);

        return redirect()
            ->route('admin.gallery-images.group', [$data['gallery_category_id'], $data['gallery_sub_category_id'] ?? 0])
            ->with('success', $n . ' gallery ' . ($n === 1 ? 'photo' : 'photos') . ' added successfully.');
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
            'image_alt' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ]);

        $this->ensureSubCategoryHasRoom($data['gallery_sub_category_id'] ?? null, $gallery_image);

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
            ->route('admin.gallery-images.group', [$gallery_image->gallery_category_id, $gallery_image->gallery_sub_category_id ?? 0])
            ->with('success', 'Gallery image updated successfully.');
    }

    /** A sub category (event) can hold at most GallerySubCategory::MAX_IMAGES photos. */
    private function ensureSubCategoryHasRoom($subCategoryId, ?GalleryImage $current = null, int $adding = 1): void
    {
        if (!$subCategoryId || ($current && (int) $current->gallery_sub_category_id === (int) $subCategoryId)) {
            return;
        }

        $max = GallerySubCategory::MAX_IMAGES;
        $count = GalleryImage::where('gallery_sub_category_id', $subCategoryId)->count();
        if ($count + $adding > $max) {
            $left = max(0, $max - $count);
            throw ValidationException::withMessages([
                'gallery_sub_category_id' => $left
                    ? "This sub category already has {$count} photos (maximum {$max}). You can add only {$left} more."
                    : "This sub category already has {$max} photos (maximum {$max}). Delete or move a photo first.",
            ]);
        }
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
        // images_count = photos already in it (the upload form shows the free places)
        $subcategories = GallerySubCategory::where('gallery_category_id', $categoryId)
            ->where('is_active', 1)
            ->select('id', 'title')
            ->withCount('images')
            ->get();

        return response()->json($subcategories);
    }
    
}
