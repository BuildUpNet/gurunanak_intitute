<?php
// routes/web.php


use App\Http\Controllers\Admin\ProgramDetailController as AdminProgramDetailController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseControllerss;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\GallerySubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavCardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramCategoryController;
use App\Http\Controllers\ProgramDetailController;
use App\Http\Controllers\ProgramItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AboutImageController;

/* ── MAIN PAGES ── */

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/about/administration', [PageController::class, 'administration'])->name('about.administration');
Route::get('/about/director-message', fn() => redirect('/about#directors-message'))->name('about.director');
Route::get('/about/vision-mission', fn() => redirect('/about#vision-mission'))->name('about.vision');
Route::get('/about/infrastructure', fn() => redirect('/about#infrastructure'))->name('about.infrastructure');
Route::get('/about/rules-regulations', fn() => redirect('/about#rules-regulations'))->name('about.rules');
// Route::get('/about/anti-ragging', [PageController::class, 'antiRagging'])->name('about.anti-ragging');
Route::get('/academics', [PageController::class, 'academics'])->name('academics');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/admissions/form', [PageController::class, 'admissionForm'])->name('admissions.form');
Route::post('/admissions/form', [AdmissionController::class, 'store'])->middleware('throttle:5,1')->name('admissions.form.store');
Route::get('/admissions/application/{application}', [AdmissionController::class, 'confirmation'])->name('admissions.application');
Route::get('/admissions/application/{application}/pdf', [AdmissionController::class, 'downloadPdf'])->name('admissions.pdf');
Route::get('/results', [PageController::class, 'results'])->name('results');
Route::get('/achievers', [PageController::class, 'achievers'])->name('achievers');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/alumni', [PageController::class, 'alumni'])->name('alumni');
Route::get('/placements', [PageController::class, 'placements'])->name('placements');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/gallery/view', [PageController::class, 'galleryView'])->name('gallery.view');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{announcement:slug}', [PageController::class, 'newsShow'])->name('news.show');
Route::get('/media', [PageController::class, 'media'])->name('media');
Route::redirect('/announcements', '/news')->name('announcements');
Route::redirect('/contact', '/contact/patiala', 301)->name('contact');
Route::get('/contact/patiala', [PageController::class, 'contactPatiala'])->name('contact.patiala');
Route::get('/contact/karnal', [PageController::class, 'contactKarnal'])->name('contact.karnal');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');

/* ── COURSE PAGES (dynamic) ── */
Route::get('/courses/{slug}', [CourseControllerss::class, 'show'])->name('courses.show');

/* ── DEPARTMENT PAGES (static first, dynamic later) ── */
Route::get('/departments/school-of-healthcare-management', fn() => view('pages.dept-healthcare'))->name('dept.healthcare');

/* ── PROGRAM DETAIL PAGES (dynamic) ── */
Route::get('/programs/{slug}', [ProgramDetailController::class, 'show'])->name('program.show');

/* ── PORTAL LOGIN ── */
Route::get('/login', [PageController::class, 'portalLogin'])->name('portal.login');

/* ── FORM SUBMISSIONS ── */
Route::post('/enquiry', [EnquiryController::class, 'store'])->middleware('throttle:5,1')->name('enquiry.store');
Route::post('/contact', [EnquiryController::class, 'contact'])->middleware('throttle:5,1')->name('contact.store');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('admin.login.submit');
// Admin logout - only logged in users
Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])
        ->name('admin.dashboard');
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::resource('gallery-categories', GalleryController::class);
    Route::resource('gallery-subcategories', GallerySubCategoryController::class);
    Route::resource('gallery-images', GalleryImageController::class);
    Route::post(
        'announcement/{announcement}/toggle-status',
        [AnnouncementController::class, 'toggleStatus']
    )->name('announcement.toggle-status');
    Route::resource('announcement', AnnouncementController::class);
});
Route::get('/get-subcategories/{categoryId}', [GalleryImageController::class, 'getSubCategories'])
    ->name('get-subcategories');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/hero-slides', [HomeController::class, 'index'])->name('hero-slides.index');
    Route::get('/hero-slides/create', [HomeController::class, 'create'])->name('hero-slides.create');
    Route::post('/hero-slides/store', [HomeController::class, 'store'])->name('hero-slides.store');
    Route::get('/hero-slides/edit/{id}', [HomeController::class, 'edit'])->name('hero-slides.edit');
    Route::post('/hero-slides/update/{id}', [HomeController::class, 'update'])->name('hero-slides.update');
    Route::delete('/hero-slides/delete/{id}', [HomeController::class, 'destroy'])->name('hero-slides.delete');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('about-images', AboutImageController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('course-categories', CourseCategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('program-categories', ProgramCategoryController::class);
    Route::resource('program-items', ProgramItemController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/nav-cards', [NavCardController::class, 'index'])->name('nav-cards.index');
    Route::post('/nav-cards', [NavCardController::class, 'update'])->name('nav-cards.update');

    Route::resource('program-details', AdminProgramDetailController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admissions', [AdmissionController::class, 'admissiondetail'])
        ->name('admissions.detail');
    Route::get('/admissions/export', [AdmissionController::class, 'exportExcel'])
        ->name('admissions.export');
    Route::get('/admissions/{application}', [AdmissionController::class, 'showlist'])
        ->name('admissions.showlist');
});

Route::get('/admin/contact-enquiries', [EnquiryController::class, 'contactList'])
    ->middleware(['auth', 'admin'])
    ->name('admin.contact-enquiries.index');

Route::get('/admin/contact-enquiries/export', [EnquiryController::class, 'exportContactExcel'])
    ->middleware(['auth', 'admin'])
    ->name('admin.contact-enquiries.export');

Route::get('/admin/enquiries', [EnquiryController::class, 'enquiryList'])
    ->middleware(['auth', 'admin'])
    ->name('admin.enquiries.index');