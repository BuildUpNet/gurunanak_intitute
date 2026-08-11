<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HasSpamProtection;
use App\Models\AdmissionApplication;
use App\Models\Course;
use App\Mail\AdmissionApplicationMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdmissionController extends Controller
{
    use HasSpamProtection;

    public function form()
    {
        $courses = Course::where('status', 1)
            ->orderBy('title', 'asc')
            ->get();

        return view('pages.admission-form', compact('courses'));
    }

    public function store(Request $request)
    {
        if ($this->isBot($request)) {
            // Honeypot filled or submitted too fast — silently drop the bot submission.
            return redirect()->route('admissions.form')
                ->with('success', 'Application submitted successfully.');
        }

        if (!$this->passesRecaptcha($request)) {
            return back()->withInput()->with('error', 'reCAPTCHA verification failed. Please try again.');
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
            'nationality'         => 'required|string|max:100',
            'country_citizenship' => 'required|string|max:100',
            'permanent_address'   => 'required|string|max:500',
            'mobile'              => 'required|digits:10',
            'email'               => 'nullable|email|max:150',
            'declaration'         => 'accepted',
        ], [
            'declaration.accepted' => 'You must accept the declaration to submit the form.',
            'aadhaar_no.digits'    => 'Aadhaar number must be exactly 12 digits.',
            'mobile.digits'        => 'Mobile number must be exactly 10 digits.',
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
            'nationality'         => $data['nationality'],
            'country_citizenship' => $data['country_citizenship'],
            'permanent_address'   => $data['permanent_address'],
            'mobile'              => $data['mobile'],
            'email'               => $data['email'] ?? null,
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

    public function exportExcel(Request $request)
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
            ->get();

        $filename = 'admission-applications-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($applications) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");
            fputcsv($handle, [
                'ID', 'Candidate Name', 'Course', 'Gender', 'Category', 'Category Other',
                'DOB', 'Place of Birth', 'Aadhaar No', 'Nationality', 'Country/Citizenship',
                'Permanent Address', 'Mobile', 'Email', 'Status', 'Submitted On',
            ]);

            foreach ($applications as $app) {
                fputcsv($handle, [
                    $app->id,
                    $app->candidate_name,
                    $app->course_name,
                    $app->gender,
                    $app->category,
                    $app->category_other,
                    optional($app->dob)->format('d-m-Y'),
                    $app->place_of_birth,
                    $app->aadhaar_no,
                    $app->nationality,
                    $app->country_citizenship,
                    $app->permanent_address,
                    $app->mobile,
                    $app->email,
                    $app->status,
                    $app->created_at->format('d-m-Y H:i'),
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}