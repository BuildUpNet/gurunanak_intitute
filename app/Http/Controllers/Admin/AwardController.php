<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    private const UPLOAD_DIR = 'uploads/awards';

    public function index(Request $request)
    {
        $awards = Award::query()
            ->when($request->filled('search'), fn($q) => $q->where('title', 'like', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.form', ['award' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $this->uploadImage($request);

        Award::create($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award added successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.form', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            $this->deleteImage($award);
            $data['image'] = $this->uploadImage($request);
        }

        $award->update($data);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        $this->deleteImage($award);
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'subtitle'    => 'nullable|string|max:150',
            'description' => 'nullable|string|max:5000',
            'image'       => ($imageRequired ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
            'status'      => 'required|in:0,1',
        ]);

        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        // Description comes from the rich-text editor — keep only the formatting tags the editor produces
        $data['description'] = isset($data['description'])
            ? strip_tags($data['description'], '<p><br><strong><b><em><i><a><ul><ol><li><h3><h4><blockquote>')
            : null;

        return $data;
    }

    private function uploadImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $name = time() . '_' . uniqid() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path(self::UPLOAD_DIR), $name);

        return $name;
    }

    private function deleteImage(Award $award): void
    {
        if ($award->image && file_exists(public_path(self::UPLOAD_DIR . '/' . $award->image))) {
            unlink(public_path(self::UPLOAD_DIR . '/' . $award->image));
        }
    }
}
