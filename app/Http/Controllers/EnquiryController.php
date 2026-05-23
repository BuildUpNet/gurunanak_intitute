<?php
// app/Http/Controllers/EnquiryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'course' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:1000',
        ]);

        // TODO: Mail::to(config('mail.admin'))->send(new \App\Mail\EnquiryMail($data));
        Log::info('GNIMT Enquiry', $data);

        return back()->with('success', 'Thank you! Our team will contact you within 24 hours.');
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'subject' => 'nullable|string|max:150',
            'course' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        Log::info('GNIMT Contact Form', $data);

        return back()->with('success', 'Your message has been received. We\'ll get back to you shortly.');
    }
}
