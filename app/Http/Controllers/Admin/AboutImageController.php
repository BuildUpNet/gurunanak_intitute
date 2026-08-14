<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutImageController extends Controller
{
    public function index(Request $request)
    {
        $query = AboutImage::orderBy('sort_order')->orderBy('id');

        if ($request->filled('search')) {
            $query->where('alt_text', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $images = $query->paginate(12)->withQueryString();

        return view('admin.about-images.index', compact('images'));
    }

    public function create()
    {
        return view('admin.about-images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'      => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'alt_text'   => 'nullable|string|max:200',
            'position'   => 'required|in:main,accent',
            'status'     => 'required|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $path = $request->file('image')->store('about-images', 'public');

        AboutImage::create([
            'image'      => $path,
            'alt_text'   => $request->alt_text,
            'position'   => $request->position,
            'status'     => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.about-images.index')
            ->with('success', 'About image added successfully.');
    }

    public function edit(AboutImage $aboutImage)
    {
        return view('admin.about-images.edit', compact('aboutImage'));
    }

    public function update(Request $request, AboutImage $aboutImage)
    {
        $request->validate([
            'image'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'alt_text'   => 'nullable|string|max:200',
            'position'   => 'required|in:main,accent',
            'status'     => 'required|in:0,1',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'alt_text'   => $request->alt_text,
            'position'   => $request->position,
            'status'     => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($aboutImage->image && Storage::disk('public')->exists($aboutImage->image)) {
                Storage::disk('public')->delete($aboutImage->image);
            }
            $data['image'] = $request->file('image')->store('about-images', 'public');
        }

        $aboutImage->update($data);

        return redirect()->route('admin.about-images.index')
            ->with('success', 'About image updated successfully.');
    }

    public function destroy(AboutImage $aboutImage)
    {
        if ($aboutImage->image && Storage::disk('public')->exists($aboutImage->image)) {
            Storage::disk('public')->delete($aboutImage->image);
        }

        $aboutImage->delete();

        return redirect()->route('admin.about-images.index')
            ->with('success', 'About image deleted successfully.');
    }
}
