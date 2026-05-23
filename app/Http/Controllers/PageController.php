<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    public function about()
    {
        return view('pages.about');
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
        return view('pages.academics');
    }
    public function admissions()
    {
        return view('pages.admissions');
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
    public function gallery()
    {
        return view('pages.gallery');
    }
    public function news()
    {
        return view('pages.news');
    }
    public function media()
    {
        return view('pages.media');
    }
    public function announcements()
    {
        return view('pages.announcements');
    }
    public function contact()
    {
        return view('pages.contact');
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
}