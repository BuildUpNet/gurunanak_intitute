<?php
// app/Http/Controllers/EnquiryController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HasSpamProtection;
use App\Mail\ContactEnquiryMail;
use App\Mail\EnquiryMail;
use App\Models\ContactEnquiry;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    use HasSpamProtection;

    public function store(Request $request)
    {
        if ($this->isBot($request)) {
            return back()->with('success', 'Thank you! Your enquiry has been submitted successfully.');
        }

        if (!$this->passesRecaptcha($request)) {
            return back()->withInput()->with('error', 'reCAPTCHA verification failed. Please try again.');
        }

        try {
            $data = $request->validate([
                'name' => 'required|string|max:100',
                'phone' => 'required|string|max:15',
                'email' => 'nullable|email|max:100',
                'course_category_id' => 'nullable|exists:course_categories,id',
                'course_id' => 'nullable|exists:courses,id',
                'branch' => 'nullable|string|max:100',
                'message' => 'nullable|string|max:1000',
            ]);

            if (!empty($data['course_category_id'])) {
                $category = \App\Models\CourseCategory::find($data['course_category_id']);
                $data['course_category'] = $category?->title;
            }

            if (!empty($data['course_id'])) {
                $course = \App\Models\Course::find($data['course_id']);
                $data['course'] = $course?->title;
            }

            Enquiry::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'course_category_id' => $data['course_category_id'] ?? null,
                'course_id' => $data['course_id'] ?? null,
                'course' => $data['course'] ?? null,
                'branch' => $data['branch'] ?? null,
                'message' => $data['message'] ?? null,
            ]);

            Mail::to(env('ADMIN_EMAIL'))->send(new EnquiryMail($data));

            return back()->with('success', 'Thank you! Your enquiry has been submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Enquiry Submit Error: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
    public function contact(Request $request)
    {
        if ($this->isBot($request)) {
            return back()->with('success', 'Your message has been received. We\'ll get back to you shortly.');
        }

        if (!$this->passesRecaptcha($request)) {
            return back()->withInput()->with('error', 'reCAPTCHA verification failed. Please try again.');
        }

        try {
            $data = $request->validate([
                'name' => 'required|string|max:100',
                'phone' => 'required|string|max:15',
                'email' => 'nullable|email|max:100',
                'subject' => 'nullable|string|max:150',
                'branch' => 'required|string|in:Patiala,Karnal',
                'course_category_id' => 'nullable|exists:course_categories,id',
                'course_id' => 'nullable|exists:courses,id',
                'message' => 'required|string|max:2000',
            ]);

            $category = null;
            $course = null;

            if (!empty($data['course_category_id'])) {
                $category = \App\Models\CourseCategory::find($data['course_category_id']);
                $data['course_category'] = $category?->title;
            }

            if (!empty($data['course_id'])) {
                $course = \App\Models\Course::find($data['course_id']);
                $data['course'] = $course?->title;
            }

            ContactEnquiry::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'subject' => $data['subject'] ?? null,
                'branch' => $data['branch'],
                'course_category_id' => $data['course_category_id'] ?? null,
                'course_id' => $data['course_id'] ?? null,
                'course' => $data['course'] ?? null,
                'message' => $data['message'],
            ]);

            Mail::to(env('ADMIN_EMAIL'))->send(new ContactEnquiryMail($data));

            return back()->with('success', 'Your message has been received. We\'ll get back to you shortly.');
        } catch (\Exception $e) {

            Log::error('Contact Form Error: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
    public function contactList(Request $request)
    {
        $enquiries = ContactEnquiry::with(['courseCategory', 'course'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('branch'), fn($q) => $q->where('branch', $request->branch))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact-enquiries.index', compact('enquiries'));
    }

    public function exportContactExcel(Request $request)
    {
        $enquiries = ContactEnquiry::with(['courseCategory', 'course'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('branch'), fn($q) => $q->where('branch', $request->branch))
            ->latest()
            ->get();

        $filename = 'contact-enquiries-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($enquiries) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Name', 'Phone', 'Email', 'Branch', 'Course Category', 'Course', 'Subject', 'Message', 'Submitted On']);

            foreach ($enquiries as $e) {
                fputcsv($handle, [
                    $e->id,
                    $e->name,
                    $e->phone,
                    $e->email,
                    $e->branch,
                    $e->courseCategory->title ?? '-',
                    $e->course->title ?? ($e->course ?? '-'),
                    $e->subject,
                    $e->message,
                    $e->created_at->format('d-m-Y H:i'),
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function enquiryList(Request $request)
    {
        $enquiries = Enquiry::with(['courseCategory'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('branch'), fn($q) => $q->where('branch', $request->branch))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.enquiries.index', compact('enquiries'));
    }
}
