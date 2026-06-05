<?php
// routes/web.php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnquiryController;
use Illuminate\Support\Facades\Route;

/* ── MAIN PAGES ── */
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/about/director-message',  fn() => redirect('/about#directors-message'))->name('about.director');
Route::get('/about/vision-mission',    fn() => redirect('/about#vision-mission'))->name('about.vision');
Route::get('/about/infrastructure',    fn() => redirect('/about#infrastructure'))->name('about.infrastructure');
Route::get('/about/rules-regulations', fn() => redirect('/about#rules-regulations'))->name('about.rules');
Route::get('/academics', [PageController::class, 'academics'])->name('academics');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/results', [PageController::class, 'results'])->name('results');
Route::get('/achievers', [PageController::class, 'achievers'])->name('achievers');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/alumni', [PageController::class, 'alumni'])->name('alumni');
Route::get('/placements', [PageController::class, 'placements'])->name('placements');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/media', [PageController::class, 'media'])->name('media');
Route::get('/announcements', [PageController::class, 'announcements'])->name('announcements');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');

/* ── COURSE PAGES (dynamic) ── */
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

/* ── PORTAL LOGIN ── */
Route::get('/login', [PageController::class, 'portalLogin'])->name('portal.login');

/* ── FORM SUBMISSIONS ── */
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::post('/contact', [EnquiryController::class, 'contact'])->name('contact.store');
