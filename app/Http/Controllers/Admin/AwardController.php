<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\AwardSection;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

/**
 * Awards & Recognition page = many sections.
 * Each AwardSection has its own title + description and many images (one `awards` row per image).
 */
class AwardController extends Controller
{
    private const UPLOAD_DIR = 'uploads/awards';

    /* ───────────── Sections ───────────── */

    public function index()
    {
        $sections = AwardSection::withCount([
            'awards',
            'awards as active_awards_count' => fn ($q) => $q->where('status', 1),
        ])->ordered()->get();

        $pageTitle       = AwardSection::pageTitle();
        $pageDescription = AwardSection::pageDescription();
        $pageEyebrow     = AwardSection::pageEyebrow();

        return view('admin.awards.index', compact('sections', 'pageTitle', 'pageDescription', 'pageEyebrow'));
    }

    public function updatePage(Request $request)
    {
        $data = $request->validate([
            'page_eyebrow'     => 'nullable|string|max:200',
            'page_title'       => 'required|string|max:200',
            'page_description' => 'nullable|string|max:2000',
        ]);

        SiteSetting::set(AwardSection::PAGE_EYEBROW_KEY, $data['page_eyebrow'] ?? '');
        SiteSetting::set(AwardSection::PAGE_TITLE_KEY, $data['page_title']);
        SiteSetting::set(AwardSection::PAGE_DESCRIPTION_KEY, $data['page_description'] ?? '');

        return redirect()->route('admin.awards.index')->with('success', 'Page heading saved.');
    }

    public function create()
    {
        $section = new AwardSection([
            'sort_order' => (int) AwardSection::max('sort_order') + 1,
            'status'     => 1,
        ]);

        return view('admin.awards.create', compact('section'));
    }

    public function store(Request $request)
    {
        $data = $this->validateSection($request);
        $request->validate($this->imageRules(false), $this->imageMessages());

        $section = AwardSection::create($data);
        $count   = $this->saveImages($request, $section);

        return redirect()->route('admin.awards.edit', $section)
            ->with('success', 'Section created' . ($count ? " with {$count} " . ($count === 1 ? 'image' : 'images') : '') . '.');
    }

    public function edit(AwardSection $awardSection)
    {
        $section = $awardSection->load('awards');

        return view('admin.awards.edit', compact('section'));
    }

    public function update(Request $request, AwardSection $awardSection)
    {
        $awardSection->update($this->validateSection($request));

        return redirect()->route('admin.awards.edit', $awardSection)->with('success', 'Section details saved.');
    }

    public function destroy(AwardSection $awardSection)
    {
        foreach ($awardSection->awards as $award) {
            $this->deleteFile($award);
        }
        $awardSection->delete(); // award rows go via FK cascade

        return redirect()->route('admin.awards.index')->with('success', 'Section deleted.');
    }

    /* ───────────── Images of a section ───────────── */

    public function storeImages(Request $request, AwardSection $awardSection)
    {
        $request->validate($this->imageRules(true), $this->imageMessages());

        $count = $this->saveImages($request, $awardSection);

        return redirect()->route('admin.awards.edit', $awardSection)
            ->with('success', $count . ' ' . ($count === 1 ? 'image' : 'images') . ' uploaded.');
    }

    public function updateImages(Request $request, AwardSection $awardSection)
    {
        $data = $request->validate([
            'order'   => 'array',
            'order.*' => 'nullable|integer|min:0',
            'active'  => 'array',
        ]);

        $active = array_keys($data['active'] ?? []);

        foreach ($awardSection->awards as $award) {
            $award->update([
                'sort_order' => (int) ($data['order'][$award->id] ?? $award->sort_order),
                'status'     => in_array($award->id, $active) ? 1 : 0,
            ]);
        }

        return redirect()->route('admin.awards.edit', $awardSection)->with('success', 'Image order & visibility saved.');
    }

    public function destroyImage(Award $award)
    {
        $sectionId = $award->award_section_id;
        $this->deleteFile($award);
        $award->delete();

        return $sectionId
            ? redirect()->route('admin.awards.edit', $sectionId)->with('success', 'Image deleted.')
            : redirect()->route('admin.awards.index')->with('success', 'Image deleted.');
    }

    /* ───────────── Helpers ───────────── */

    private function validateSection(Request $request): array
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string|max:2000',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['status']     = $request->boolean('status') ? 1 : 0;

        return $data;
    }

    private function imageRules(bool $required): array
    {
        return [
            'images'   => ($required ? 'required' : 'nullable') . '|array|max:20',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }

    private function imageMessages(): array
    {
        return [
            'images.required' => 'Please select at least one image.',
            'images.max'      => 'You can upload up to 20 images at a time.',
            'images.*.image'  => 'Each file must be an image (JPG, PNG or WEBP).',
            'images.*.mimes'  => 'Each file must be an image (JPG, PNG or WEBP).',
            'images.*.max'    => 'Each image must be 4 MB or smaller.',
        ];
    }

    private function saveImages(Request $request, AwardSection $section): int
    {
        $files = $request->file('images') ?? [];
        $order = (int) $section->awards()->max('sort_order');

        foreach ($files as $file) {
            $name = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move(public_path(self::UPLOAD_DIR), $name);

            $section->awards()->create([
                // Original file name doubles as the image alt text
                'title'      => mb_substr(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 200) ?: 'Award',
                'image'      => $name,
                'sort_order' => ++$order,
                'status'     => 1,
            ]);
        }

        return count($files);
    }

    private function deleteFile(Award $award): void
    {
        if ($award->image && file_exists(public_path(self::UPLOAD_DIR . '/' . $award->image))) {
            unlink(public_path(self::UPLOAD_DIR . '/' . $award->image));
        }
    }
}
