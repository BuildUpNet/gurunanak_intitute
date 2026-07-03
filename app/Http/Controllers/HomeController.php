<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
 public function index(Request $request)
    {
        $slides = HeroSlide::query()
            ->when($request->filled('search'), fn($q) => $q->where('alt_text', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->orderBy('sort_order', 'asc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/hero-slides'), $imageName);
        }

        HeroSlide::create([
            'image' => $imageName,
            'alt_text' => $request->alt_text,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide added successfully.');
    }

    public function edit($id)
    {
        $slide = HeroSlide::findOrFail($id);
        return view('admin.hero-slides.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = HeroSlide::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $imageName = $slide->image;

        if ($request->hasFile('image')) {
            $oldImage = public_path('uploads/hero-slides/' . $slide->image);

            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/hero-slides'), $imageName);
        }

        $slide->update([
            'image' => $imageName,
            'alt_text' => $request->alt_text,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy($id)
    {
        $slide = HeroSlide::findOrFail($id);

        $imagePath = public_path('uploads/hero-slides/' . $slide->image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $slide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide deleted successfully.');
    }
}
