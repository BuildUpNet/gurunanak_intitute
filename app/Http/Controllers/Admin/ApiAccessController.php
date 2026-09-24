<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Http\Request;

/** Admin → API Access: API documentation + key management for the read-only form-submission API. */
class ApiAccessController extends Controller
{
    public function index()
    {
        $keys = ApiKey::latest()->get();

        return view('admin.api-access.index', [
            'keys'      => $keys,
            'endpoints' => $this->endpoints(),
            'baseUrl'   => url('/api/v1'),
        ]);
    }

    /** Full developer guide — printable / save as PDF to share with a developer */
    public function docs()
    {
        return view('admin.api-access.docs', [
            'endpoints' => $this->endpoints(),
            'baseUrl'   => url('/api/v1'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100']);

        [, $plain] = ApiKey::generate($data['name']);

        // Plain key is flashed once — only its hash is stored
        return redirect()->route('admin.api-access.index')
            ->with('new_api_key', $plain)
            ->with('success', 'API key created. Copy it now — it will not be shown again.');
    }

    public function toggle(ApiKey $apiKey)
    {
        $apiKey->update(['status' => ! $apiKey->status]);

        return redirect()->route('admin.api-access.index')
            ->with('success', 'API key ' . ($apiKey->status ? 'enabled' : 'disabled') . '.');
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();

        return redirect()->route('admin.api-access.index')->with('success', 'API key deleted.');
    }

    /** Documentation shown on the index + docs pages — keep in sync with routes/api.php and the API Resources */
    private function endpoints(): array
    {
        $common = [
            ['search', 'text', 'Text in name, phone/mobile or email', 'search=9876'],
            ['from', 'date', 'Submitted on/after this date (YYYY-MM-DD)', 'from=2026-09-01'],
            ['to', 'date', 'Submitted on/before this date (YYYY-MM-DD)', 'to=2026-09-30'],
            ['per_page', 'number', 'Records per page, 1–100 (default 20)', 'per_page=50'],
            ['page', 'number', 'Page number (default 1)', 'page=2'],
        ];
        $branch = ['branch', 'text', 'Exact branch value as submitted, e.g. "Patiala Branch"', 'branch=Patiala Branch'];

        return [
            [
                'key'    => 'admissions',
                'title'  => 'Admission Form',
                'about'  => 'Full online admission applications submitted from the "Admission Form" page.',
                'icon'   => 'fas fa-file-alt',
                'list'   => '/admissions',
                'single' => '/admissions/{id}',
                'params' => array_merge($common, [['course_name', 'text', 'Exact course name', 'course_name=Dialysis Technology']]),
                'fields' => [
                    ['id', 'number', 'Unique application ID'],
                    ['candidate_name', 'text', 'Student name'],
                    ['course_name', 'text', 'Course applied for'],
                    ['gender', 'text', 'Male / Female / Other'],
                    ['category', 'text', 'General / SC / BC / Other ...'],
                    ['category_other', 'text|null', 'Filled only when category is "Other"'],
                    ['dob', 'date', 'Date of birth (YYYY-MM-DD)'],
                    ['place_of_birth', 'text', 'Place of birth'],
                    ['aadhaar_no', 'text', 'Aadhaar number (sensitive — keep private)'],
                    ['nationality', 'text', 'Nationality'],
                    ['country_citizenship', 'text', 'Country of citizenship'],
                    ['permanent_address', 'text', 'Permanent address'],
                    ['mobile', 'text', 'Mobile number'],
                    ['email', 'text|null', 'Email address'],
                    ['status', 'text', 'Application status, e.g. Pending'],
                    ['submitted_at', 'datetime', 'When the form was submitted (UTC, ISO 8601)'],
                ],
                'sample' => [
                    'id' => 5, 'candidate_name' => 'Aman Singh', 'course_name' => 'Dialysis Technology', 'gender' => 'Male',
                    'category' => 'General', 'category_other' => null, 'dob' => '1998-03-15', 'place_of_birth' => 'Sangrur',
                    'aadhaar_no' => 'XXXXXXXX1234', 'nationality' => 'Indian', 'country_citizenship' => 'India',
                    'permanent_address' => 'Sangrur, Punjab', 'mobile' => '98XXXXXX55', 'email' => 'aman@example.com',
                    'status' => 'Pending', 'submitted_at' => '2026-09-24T07:12:18+00:00',
                ],
            ],
            [
                'key'    => 'enquiries',
                'title'  => 'Quick Admission Enquiries',
                'about'  => 'Short enquiry form on the Home page and the Admissions page.',
                'icon'   => 'fas fa-bolt',
                'list'   => '/enquiries',
                'single' => '/enquiries/{id}',
                'params' => array_merge($common, [$branch]),
                'fields' => [
                    ['id', 'number', 'Unique enquiry ID'],
                    ['name', 'text', 'Name'],
                    ['phone', 'text', 'Phone number'],
                    ['email', 'text|null', 'Email address'],
                    ['branch', 'text|null', 'Branch selected (Patiala / Karnal)'],
                    ['course_category', 'text|null', 'Department / school selected'],
                    ['course', 'text|null', 'Course selected'],
                    ['message', 'text|null', 'Message written by the visitor'],
                    ['submitted_at', 'datetime', 'When the form was submitted (UTC, ISO 8601)'],
                ],
                'sample' => [
                    'id' => 4, 'name' => 'Priya Sharma', 'phone' => '+9178XXXXXX15', 'email' => 'priya@example.com',
                    'branch' => 'Patiala Branch', 'course_category' => null, 'course' => 'B.Voc Dialysis Technology',
                    'message' => 'Please share fee details', 'submitted_at' => '2026-09-20T13:27:55+00:00',
                ],
            ],
            [
                'key'    => 'contact-enquiries',
                'title'  => 'Contact Form (Patiala & Karnal)',
                'about'  => 'Contact form on the "Contact Patiala" and "Contact Karnal" pages.',
                'icon'   => 'fas fa-envelope',
                'list'   => '/contact-enquiries',
                'single' => '/contact-enquiries/{id}',
                'params' => array_merge($common, [$branch]),
                'fields' => [
                    ['id', 'number', 'Unique enquiry ID'],
                    ['name', 'text', 'Name'],
                    ['phone', 'text', 'Phone number'],
                    ['email', 'text|null', 'Email address'],
                    ['branch', 'text|null', 'Which contact page / branch'],
                    ['subject', 'text|null', 'Subject'],
                    ['course_category', 'text|null', 'Department / school selected'],
                    ['course', 'text|null', 'Course selected'],
                    ['message', 'text|null', 'Message written by the visitor'],
                    ['submitted_at', 'datetime', 'When the form was submitted (UTC, ISO 8601)'],
                ],
                'sample' => [
                    'id' => 3, 'name' => 'Rohit Kumar', 'phone' => '+9178XXXXXX15', 'email' => 'rohit@example.com',
                    'branch' => 'Karnal', 'subject' => 'Hostel facility', 'course_category' => null,
                    'course' => 'B.Voc Ophthalmic', 'message' => 'Is hostel available?', 'submitted_at' => '2026-09-18T11:50:28+00:00',
                ],
            ],
        ];
    }
}
