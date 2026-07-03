<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
public function index(Request $request)
{
    $faqs = Faq::query()
        ->when($request->filled('search'), fn($q) => $q->where('question', 'LIKE', '%' . $request->search . '%'))
        ->when($request->filled('page_name'), fn($q) => $q->where('page_name', $request->page_name))
        ->orderBy('sort_order')
        ->paginate(10)
        ->withQueryString();

    $pageNames = Faq::select('page_name')->distinct()->orderBy('page_name')->pluck('page_name');

    return view('admin.faqs.index', compact('faqs', 'pageNames'));
}
  public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:100',
            'faqs' => 'required|array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
            'faqs.*.sort_order' => 'nullable|integer',
            'faqs.*.status' => 'required|in:0,1',
        ]);

        foreach ($request->faqs as $faq) {
            Faq::create([
                'page_name' => $request->page_name,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $faq['sort_order'] ?? 0,
                'status' => $faq['status'] ?? 1,
            ]);
        }

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQs added successfully.');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'page_name' => 'required|string|max:100',
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $faq->update([
            'page_name' => $request->page_name,
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}
