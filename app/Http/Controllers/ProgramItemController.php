<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategory;
use App\Models\ProgramItem;
use Illuminate\Http\Request;

class ProgramItemController extends Controller
{
    public function index(Request $request)
    {
        $programItems = ProgramItem::with('programCategory')
            ->when($request->filled('search'), fn($q) => $q->where('title', 'LIKE', '%' . $request->search . '%'))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('program_category_id'), fn($q) => $q->where('program_category_id', $request->program_category_id))
            ->orderBy('sort_order', 'asc')
            ->paginate(10)
            ->withQueryString();

        $programCategories = ProgramCategory::where('status', 1)->orderBy('sort_order', 'asc')->get();

        return view('admin.program-items.index', compact('programItems', 'programCategories'));
    }

    public function create()
    {
        $programCategories = ProgramCategory::where('status', 1)->orderBy('sort_order', 'asc')->get();
        return view('admin.program-items.form', compact('programCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_category_id' => 'required|exists:program_categories,id',
            'title'               => 'required|max:255',
            'url'                 => 'required|string|max:500',
            'sort_order'          => 'nullable|integer',
            'status'              => 'required|in:0,1',
        ]);

        ProgramItem::create([
            'program_category_id' => $request->program_category_id,
            'title'               => $request->title,
            'url'                 => $request->url,
            'sort_order'          => $request->sort_order ?? 0,
            'status'              => $request->status,
        ]);

        return redirect()->route('admin.program-items.index')
            ->with('success', 'Program item added successfully');
    }

    public function edit(ProgramItem $programItem)
    {
        $programCategories = ProgramCategory::where('status', 1)->orderBy('sort_order', 'asc')->get();
        return view('admin.program-items.form', compact('programItem', 'programCategories'));
    }

    public function update(Request $request, ProgramItem $programItem)
    {
        $request->validate([
            'program_category_id' => 'required|exists:program_categories,id',
            'title'               => 'required|max:255',
            'url'                 => 'required|string|max:500',
            'sort_order'          => 'nullable|integer',
            'status'              => 'required|in:0,1',
        ]);

        $programItem->update([
            'program_category_id' => $request->program_category_id,
            'title'               => $request->title,
            'url'                 => $request->url,
            'sort_order'          => $request->sort_order ?? 0,
            'status'              => $request->status,
        ]);

        return redirect()->route('admin.program-items.index')
            ->with('success', 'Program item updated successfully');
    }

    public function destroy(ProgramItem $programItem)
    {
        $programItem->delete();

        return back()->with('success', 'Program item deleted successfully');
    }
}
