<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\HeroSlide;
use App\Models\ProgramCategory;
use Illuminate\Http\Request;
use App\Models\ProgramDetail;
use App\Models\Announcement;
use App\Models\AdmissionApplication;
use App\Models\AboutImage;

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
        $categories = GalleryCategory::where('is_active', 1)
            ->with([
                'subcategories' => function ($q) {
                    $q->where('is_active', 1);
                }
            ])
            ->latest()
            ->get();

        $selectedCategory = $request->get('category');
        $selectedSubCategory = $request->get('subcategory');

        $images = GalleryImage::with(['category', 'subCategory'])
            ->where('is_active', 1)
            ->when($selectedCategory, function ($q) use ($selectedCategory) {
                $q->where('gallery_category_id', $selectedCategory);
            })
            ->when($selectedSubCategory, function ($q) use ($selectedSubCategory) {
                $q->where('gallery_sub_category_id', $selectedSubCategory);
            })
            ->latest()
            ->paginate(9);

        return view('pages.gallery', compact(
            'categories',
            'images',
            'selectedCategory',
            'selectedSubCategory'
        ));
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
        $totalCourses = Course::count();
        $totalPrograms = ProgramDetail::count();
        $totalAnnouncements = Announcement::count();
        $totalAdmissions = AdmissionApplication::count();

        $latestAnnouncements = Announcement::latest()->take(3)->get();
        $latestAdmissions = AdmissionApplication::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalPrograms',
            'totalAnnouncements',
            'totalAdmissions',
            'latestAnnouncements',
            'latestAdmissions'
        ));
    }
}