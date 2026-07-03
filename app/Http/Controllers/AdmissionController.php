<?php

namespace App\Http\Controllers;

use App\Models\AdmissionApplication;
use App\Models\Course;
use App\Mail\AdmissionApplicationMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdmissionController extends Controller
{
    public function form()
    {
        $courses = Course::where('status', 1)
            ->orderBy('title', 'asc')
            ->get();

        return view('pages.admission-form', compact('courses'));
    }

    public function store(Request $request)
    {
        if ($request->filled('website')) {
            // Hidden honeypot field was filled — silently drop the bot submission.
            return redirect()->route('admissions.form')
                ->with('success', 'Application submitted successfully.');
        }

        $data = $request->validate([
            'candidate_name'      => 'required|string|max:150',
            'course_name'         => 'required|string|max:150',
            'gender'              => 'required|in:Male,Female,Other',
            'category'            => 'required|in:General,SC,ST,OBC,Other',
            'category_other'      => 'nullable|string|max:100',
            'dob'                 => 'required|date|before:today',
            'place_of_birth'      => 'required|string|max:100',
            'aadhaar_no'          => 'required|digits:12',
            'father_name'         => 'required|string|max:150',
            'father_occupation'   => 'nullable|string|max:100',
            'father_mobile'       => 'nullable|digits:10',
            'mother_name'         => 'required|string|max:150',
            'mother_occupation'   => 'nullable|string|max:100',
            'mother_mobile'       => 'nullable|digits:10',
            'nationality'         => 'required|string|max:100',
            'country_citizenship' => 'required|string|max:100',
            'permanent_address'   => 'required|string|max:500',
            'mobile'              => 'required|digits:10',
            'email'               => 'nullable|email|max:150',

            'education'           => 'nullable|array',
            'education.*.session' => 'nullable|string|max:20',
            'education.*.school'  => 'nullable|string|max:200',
            'education.*.board'   => 'nullable|string|max:100',
            'education.*.percent' => 'nullable|string|max:20',

            'heard_from'          => 'nullable|array',
            'heard_from.*'        => 'string|max:50',
            'heard_from_other'    => 'nullable|string|max:100',
            'declaration'         => 'accepted',
        ], [
            'declaration.accepted' => 'You must accept the declaration to submit the form.',
            'aadhaar_no.digits'    => 'Aadhaar number must be exactly 12 digits.',
            'mobile.digits'        => 'Mobile number must be exactly 10 digits.',
            'father_mobile.digits' => 'Father\'s mobile number must be exactly 10 digits.',
            'mother_mobile.digits' => 'Mother\'s mobile number must be exactly 10 digits.',
        ]);

        $application = AdmissionApplication::create([
            'candidate_name'      => $data['candidate_name'],
            'course_name'         => $data['course_name'],
            'gender'              => $data['gender'],
            'category'            => $data['category'],
            'category_other'      => $data['category_other'] ?? null,
            'dob'                 => $data['dob'],
            'place_of_birth'      => $data['place_of_birth'],
            'aadhaar_no'          => $data['aadhaar_no'],
            'father_name'         => $data['father_name'],
            'father_occupation'   => $data['father_occupation'] ?? null,
            'father_mobile'       => $data['father_mobile'] ?? null,
            'mother_name'         => $data['mother_name'],
            'mother_occupation'   => $data['mother_occupation'] ?? null,
            'mother_mobile'       => $data['mother_mobile'] ?? null,
            'nationality'         => $data['nationality'],
            'country_citizenship' => $data['country_citizenship'],
            'permanent_address'   => $data['permanent_address'],
            'mobile'              => $data['mobile'],
            'email'               => $data['email'] ?? null,
            'education'           => $data['education'] ?? [],
            'heard_from'          => $data['heard_from'] ?? [],
            'heard_from_other'    => $data['heard_from_other'] ?? null,
        ]);

        Mail::to(env('ADMIN_EMAIL'))->send(new AdmissionApplicationMail($application));

        Log::info('GNIMT Admission Application #' . $application->id, [
            'name'   => $application->candidate_name,
            'course' => $application->course_name,
            'mobile' => $application->mobile,
        ]);

        return redirect()->route('admissions.application', $application->id)
            ->with('success', 'Application submitted successfully.');
    }

    public function confirmation(AdmissionApplication $application)
    {
        return view('pages.admission-confirmation', compact('application'));
    }

    public function downloadPdf(AdmissionApplication $application)
    {
        $pdf = Pdf::loadView('pdf.admission-form', ['app' => $application])
            ->setPaper('a4', 'portrait');

        $filename = 'GNIMT-Admission-Form-' . $application->id . '-' . str_replace(' ', '-', $application->candidate_name) . '.pdf';

        return $pdf->download($filename);
    }

    public function admissiondetail(Request $request)
    {
        $applications = AdmissionApplication::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('candidate_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('mobile', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('course_name'), fn($q) => $q->where('course_name', $request->course_name))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $courseNames = AdmissionApplication::select('course_name')->distinct()->orderBy('course_name')->pluck('course_name');

        return view('admin.admissions.index', compact('applications', 'courseNames'));
    }

    public function showlist(AdmissionApplication $application)
    {
        return view('admin.admissions.show', compact('application'));
    }
}