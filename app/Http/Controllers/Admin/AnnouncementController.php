<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'news';
        $slug = $base;
        $i = 2;

        while (
            Announcement::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
    public function index(Request $request)
    {
        $announcements = Announcement::query()
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();
        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcement.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'tag' => 'nullable|string|max:50',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request);
        }

        Announcement::create($data);

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Announcement added successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'tag' => 'nullable|string|max:50',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_image' => 'nullable|boolean',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        if ($data['title'] !== $announcement->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $announcement->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteImage($announcement->image);
            $data['image'] = $this->storeImage($request);
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($announcement->image);
            $data['image'] = null;
        }

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->deleteImage($announcement->image);
        $announcement->delete();

        return back()->with('success', 'Announcement deleted successfully.');
    }

    private function storeImage(Request $request): string
    {
        $path = public_path('uploads/announcements');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filename = time() . '_' . Str::random(8) . '.' . $request->image->extension();
        $request->image->move($path, $filename);

        return 'uploads/announcements/' . $filename;
    }

    private function deleteImage(?string $image): void
    {
        if ($image && File::exists(public_path($image))) {
            File::delete(public_path($image));
        }
    }
    public function toggleStatus(Announcement $announcement)
    {
        $announcement->update([
            'status' => $announcement->status ? 0 : 1
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
