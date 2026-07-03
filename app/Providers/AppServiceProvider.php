<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use App\Models\GalleryCategory;
use App\Models\CourseCategory;
use App\Models\ProgramCategory;
use App\Models\ProgramDetail;
use App\Models\Announcement;
use App\Models\Faq;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {

            if (str_starts_with($view->getName(), 'admin.')) {
                return;
            }

            $categories = GalleryCategory::where('is_active', 1)
                ->with(['subcategories' => function ($q) {
                    $q->where('is_active', 1);
                }])
                ->latest()
                ->get();

            $courseCategories = CourseCategory::where('status', 1)
                ->with(['programDetails' => function ($q) {
                    $q->where('status', 1)
                        ->orderBy('sort_order', 'asc');
                }])
                ->orderBy('sort_order', 'asc')
                ->get();

            $programCategories = ProgramCategory::where('status', 1)
                ->with(['programLevels' => function ($q) {
                    $q->whereHas('programDetail', function ($q2) {
                        $q2->where('status', 1);
                    })->orderBy('sort_order', 'asc');
                }])
                ->orderBy('sort_order', 'asc')
                ->get();

            $programPageDetails = ProgramDetail::where('status', 1)
                ->orderBy('sort_order')
                ->orderBy('title')
                ->get(['id', 'program_category_id', 'slug', 'title', 'short_name', 'level']);

            $announcements = Announcement::where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Page Wise Dynamic FAQs
            |--------------------------------------------------------------------------
            */

            $routeName = request()->route()?->getName();

            $pageName = match ($routeName) {
                'home'            => 'home',
                'about'           => 'about',
                'contact.patiala' => 'contact_patiala',
                'contact.karnal'  => 'contact_karnal',
                'gallery'         => 'gallery',
                'news'            => 'news',
                'admissions'      => 'admission',      // Admissions page
                'admissions.form' => 'admission_form', // Admission form page
                'placements' => 'placement',
                'gallery'         => 'gallery',
                'placements'      => 'placement',
                'achievers'       => 'achievers',
                'results'          => 'results',
                'about.anti-ragging' => 'anti_ragging',
                default => null,
            };

            // Course page te global FAQ nahi aayega
            if (request()->routeIs('courses.show') || request()->routeIs('course.detail')) {
                $globalFaqs = collect();
            } else {
                $globalFaqs = $pageName
                    ? Faq::where('page_name', $pageName)
                    ->where('status', 1)
                    ->orderBy('sort_order', 'asc')
                    ->get()
                    : collect();
            }

            $view->with([
                'categories'         => $categories,
                'courseCategories'   => $courseCategories,
                'programCategories'  => $programCategories,
                'programPageDetails' => $programPageDetails,
                'announcements'      => $announcements,
                'globalFaqs'         => $globalFaqs,
            ]);
        });
    }
}
