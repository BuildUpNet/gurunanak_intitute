<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Support\PathPaginator;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\GallerySubCategory;
use App\Models\HeroSlide;
use App\Models\ProgramCategory;
use Illuminate\Http\Request;
use App\Models\ProgramDetail;
use App\Models\Announcement;
use App\Models\AdmissionApplication;
use App\Models\AboutImage;
use App\Models\AwardSection;
use App\Models\SiteSetting;

class PageController extends Controller
{
    public function home()
    {
        $announcements = Announcement::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        $slides = HeroSlide::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $courseCategories = CourseCategory::with(['courses' => function ($q) {
            $q->where('status', 1)->orderBy('title', 'asc');
        }])
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        $aboutMainImage = AboutImage::active()->where('position', 'main')->orderBy('sort_order')->first();
        $aboutAccentImage = AboutImage::active()->where('position', 'accent')->orderBy('sort_order')->first();

        return view('pages.home', compact('slides', 'announcements', 'courseCategories', 'aboutMainImage', 'aboutAccentImage'));
    }
    public function about()
    {
        $aboutMainImage = AboutImage::active()->where('position', 'main')->orderBy('sort_order')->first();
        $aboutAccentImage = AboutImage::active()->where('position', 'accent')->orderBy('sort_order')->first();

        return view('pages.about', compact('aboutMainImage', 'aboutAccentImage'));
    }

    public function awards()
    {
        // Only active sections that have at least one active image
        $sections = AwardSection::active()->ordered()
            ->with('activeAwards')
            ->whereHas('activeAwards')
            ->get();

        $pageTitle = AwardSection::pageTitle();
        $pageDescription = AwardSection::pageDescription();
        $pageEyebrow = AwardSection::pageEyebrow();

        return view('pages.awards', compact('sections', 'pageTitle', 'pageDescription', 'pageEyebrow'));
    }

    public function administration()
    {
        return view('pages.administration');
    }

    public function antiRagging()
    {
        return view('pages.anti-ragging');
    }
    public function director()
    {
        return view('pages.director');
    }
    public function vision()
    {
        return view('pages.vision');
    }
    public function infrastructure()
    {
        return view('pages.infrastructure');
    }
    public function rules()
    {
        return view('pages.rules');
    }
    public function academics()
    {
        $courseCategories = CourseCategory::where('status', 1)
            ->with(['programDetails' => fn($q) => $q->where('status', 1)->orderBy('sort_order')])
            ->orderBy('sort_order')->get();

        $programCategories = ProgramCategory::where('status', 1)
            ->with(['programLevels' => fn($q) => $q->whereHas('programDetail', fn($q2) => $q2->where('status', 1))->orderBy('sort_order')])
            ->orderBy('sort_order')->get();

        return view('pages.academics', compact('courseCategories', 'programCategories'));
    }

    public function admissions()
    {
        return view('pages.admissions');
    }
    public function admissionForm()
    {
        $courses = Course::where('status', 1)
            ->orderBy('title', 'asc')
            ->get();
        return view('pages.admission-form', compact('courses'));
    }
    public function results()
    {
        return view('pages.results');
    }
    public function achievers()
    {
        return view('pages.achievers');
    }
    public function testimonials()
    {
        return view('pages.testimonials');
    }
    public function alumni()
    {
        return view('pages.alumni');
    }
    public function placements()
    {
        return view('pages.placements');
    }
    public function gallery(Request $request)
    {
        // Route params read by name: /gallery/{category}[/{sub}][/page/{page}]
        $category = $request->route('category');
        $sub = $request->route('sub');
        $page = $request->route('page');
        $page = $page === null ? null : (int) $page;

        $categories = GalleryCategory::where('is_active', 1)
            ->with([
                'subcategories' => function ($q) {
                    $q->where('is_active', 1);
                }
            ])
            ->withCount(['images' => function ($q) {
                $q->where('is_active', 1);
            }])
            ->latest()
            ->get();

        // Old links (?category=ID&subcategory=ID&page=N) → 301 to the clean URL
        if ($request->hasAny(['category', 'subcategory', 'page'])) {
            $oldCat = $categories->firstWhere('id', (int) $request->query('category'))
                ?? ($category ? $categories->firstWhere('slug', $category) : null)
                ?? $categories->first();
            $oldSub = $oldCat ? $oldCat->subcategories->firstWhere('id', (int) $request->query('subcategory')) : null;
            $oldSub ??= ($oldCat && $sub) ? $oldCat->subcategories->firstWhere('slug', $sub) : null;

            return redirect()->to($this->galleryUrl($oldCat, $oldSub, (int) $request->query('page', $page ?? 1)), 301);
        }

        // /gallery → first album (there is no "All" view)
        if (!$category) {
            return $categories->isNotEmpty()
                ? redirect()->to($this->galleryUrl($categories->first()))
                : view('pages.gallery', [
                    'categories' => $categories, 'activeCategory' => null, 'activeSub' => null,
                    'selectedCategory' => null, 'selectedSubCategory' => null,
                    'groupImages' => null, 'blocks' => null, 'totalPhotos' => 0,
                ]);
        }

        $activeCategory = $categories->first(fn($c) => strcasecmp($c->slug, $category) === 0);
        abort_unless($activeCategory, 404);
        $activeSub = $sub ? $activeCategory->subcategories->first(fn($s) => strcasecmp($s->slug, $sub) === 0) : null;
        abort_if($sub && !$activeSub, 404);

        // Same page must have one URL: lower-case slugs, no "/page/1"
        $pageInUrl = $page !== null;
        $page = max(1, (int) ($page ?? 1));
        if ($category !== $activeCategory->slug || ($activeSub && $sub !== $activeSub->slug) || ($pageInUrl && $page === 1)) {
            return redirect()->to($this->galleryUrl($activeCategory, $activeSub, $page), 301);
        }

        $selectedCategory = $activeCategory->id;
        $selectedSubCategory = $activeSub->id ?? null;
        $basePath = $this->galleryUrl($activeCategory, $activeSub);

        $imagesQuery = GalleryImage::with(['category', 'subCategory'])
            ->where('is_active', 1)
            ->where('gallery_category_id', $selectedCategory ?? 0)
            ->when($selectedSubCategory, function ($q) use ($selectedSubCategory) {
                $q->where('gallery_sub_category_id', $selectedSubCategory);
            })
            ->displayOrder();

        $view = compact('categories', 'activeCategory', 'activeSub', 'selectedCategory', 'selectedSubCategory');

        // Design 1 — group photos: plain equal-height photo grid
        if ($activeCategory && $activeCategory->isGroupStyle()) {
            $total = (clone $imagesQuery)->count();
            // A sub category shows at most MAX_IMAGES photos (fits on one page)
            $rows = $activeSub
                ? $imagesQuery->take(GallerySubCategory::MAX_IMAGES)->get()
                : $imagesQuery->forPage($page, 12)->get();
            if ($activeSub) {
                $total = min($total, GallerySubCategory::MAX_IMAGES);
            }
            $groupImages = new PathPaginator($rows, $total, 12, $page, ['path' => $basePath]);
            abort_if($page > max(1, $groupImages->lastPage()), 404);

            return view('pages.gallery', $view + [
                'groupImages' => $groupImages,
                'blocks' => null,
                'totalPhotos' => $groupImages->total(),
            ]);
        }

        // Design 2 — events: one block per sub category; photos without a sub
        // category form one block for the category. Order: category's own block
        // → sub categories by event date (newest first).
        // A sub category (event) shows at most MAX_IMAGES photos
        $images = $imagesQuery->get()
            ->groupBy(fn($img) => $img->subCategory ? $img->gallery_sub_category_id : 0)
            ->map(fn($items, $key) => $key ? $items->take(GallerySubCategory::MAX_IMAGES) : $items);
        $totalPhotos = $images->sum(fn($items) => $items->count());

        $allBlocks = $images
            ->map(function ($items) {
                $first = $items->first();
                $sub = $first->subCategory;

                return (object) [
                    'title' => $sub ? $sub->displayTitle() : ($first->category->title ?? 'Campus Gallery'),
                    'desc' => $sub ? $sub->description : ($first->category->short_description ?? null),
                    'date' => $sub->event_date ?? null,
                    // Number circle: sub category decides (show / hide, custom text); category block = auto
                    'showNo' => $sub ? (bool) $sub->show_number : true,
                    'noLabel' => $sub->number_label ?? null,
                    'items' => $items->values(),
                    'sortSub' => $sub ? 1 : 0,
                    'sortDate' => $sub && $sub->event_date ? -$sub->event_date->timestamp : PHP_INT_MAX,
                    'sortId' => $sub->id ?? 0,
                ];
            })
            ->sort(fn($a, $b) => [$a->sortSub, $a->sortDate, $a->sortId] <=> [$b->sortSub, $b->sortDate, $b->sortId])
            ->values();

        $perPage = 6;
        $blocks = new PathPaginator(
            $allBlocks->forPage($page, $perPage)->values(),
            $allBlocks->count(),
            $perPage,
            $page,
            ['path' => $basePath]
        );
        abort_if($page > max(1, $blocks->lastPage()), 404);

        return view('pages.gallery', $view + [
            'groupImages' => null,
            'blocks' => $blocks,
            'totalPhotos' => $totalPhotos,
        ]);
    }

    /** Clean gallery URL: /gallery/{category}[/{sub}][/page/{n}] */
    private function galleryUrl($category, $sub = null, int $page = 1): string
    {
        if (!$category) {
            return route('gallery');
        }

        if ($page > 1) {
            return $sub
                ? route('gallery.sub.page', [$category->slug, $sub->slug, $page])
                : route('gallery.category.page', [$category->slug, $page]);
        }

        return $sub
            ? route('gallery.sub', [$category->slug, $sub->slug])
            : route('gallery.category', $category->slug);
    }

    public function galleryView(Request $request)
    {
        $selectedCategory = $request->get('category');
        $selectedSubCategory = $request->get('subcategory');
        $activeImageId = (int) $request->get('image', 0);

        $images = GalleryImage::with(['category', 'subCategory'])
            ->where('is_active', 1)
            ->when($selectedCategory, function ($q) use ($selectedCategory) {
                $q->where('gallery_category_id', $selectedCategory);
            })
            ->when($selectedSubCategory, function ($q) use ($selectedSubCategory) {
                $q->where('gallery_sub_category_id', $selectedSubCategory);
            })
            ->latest()
            ->get();

        $startIndex = $images->search(fn($img) => $img->id === $activeImageId) ?: 0;

        return view('pages.gallery-view', compact(
            'images',
            'startIndex',
            'selectedCategory',
            'selectedSubCategory'
        ));
    }

    public function news()
    {
        $newsItems = Announcement::where('status', 1)
            ->orderByRaw('date IS NULL, date DESC')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.news', compact('newsItems'));
    }

    public function newsShow(Announcement $announcement)
    {
        abort_unless($announcement->status == 1, 404);

        $related = Announcement::where('status', 1)
            ->where('id', '!=', $announcement->id)
            ->orderByRaw('date IS NULL, date DESC')
            ->limit(3)
            ->get();

        return view('pages.news-show', ['news' => $announcement, 'related' => $related]);
    }
    public function media()
    {
        return view('pages.media');
    }
    public function contactPatiala()
    {
        $courseCategories = CourseCategory::with(['courses' => function ($q) {
            $q->where('status', 1)->orderBy('title', 'asc');
        }])
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.contact-patiala', compact('courseCategories'));
    }
    public function contactKarnal()
    {
        $courseCategories = CourseCategory::with(['courses' => function ($q) {
            $q->where('status', 1)->orderBy('title', 'asc');
        }])
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.contact-karnal', compact('courseCategories'));
    }
    public function privacy()
    {
        return view('pages.privacy');
    }
    public function terms()
    {
        return view('pages.terms');
    }
    public function disclaimer()
    {
        return view('pages.disclaimer');
    }
    public function portalLogin()
    {
        return view('pages.portal-login');
    }
    public function dashboard()
    {
        // Staff only get the numbers for sections their role can open
        $user = auth()->user();
        $canPrograms = $user->can('programs.manage');
        $canAnnouncements = $user->can('announcements.manage');
        $canForms = $user->can('forms.view');
        $canGallery = $user->can('gallery.manage');

        $totalCourses = $canPrograms ? Course::count() : null;
        $totalPrograms = $canPrograms ? ProgramDetail::count() : null;
        $totalAnnouncements = $canAnnouncements ? Announcement::count() : null;
        $totalAdmissions = $canForms ? AdmissionApplication::count() : null;
        $totalGalleryImages = $canGallery ? GalleryImage::count() : null;
        $totalGalleryCategories = $canGallery ? GalleryCategory::count() : null;

        $latestAnnouncements = $canAnnouncements ? Announcement::latest()->take(3)->get() : null;
        $latestAdmissions = $canForms ? AdmissionApplication::latest()->take(3)->get() : null;

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalPrograms',
            'totalAnnouncements',
            'totalAdmissions',
            'totalGalleryImages',
            'totalGalleryCategories',
            'latestAnnouncements',
            'latestAdmissions'
        ));
    }
}