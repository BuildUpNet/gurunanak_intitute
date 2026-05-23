<?php
// app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /* All courses data — add DB later, static for now */
    private static array $courses = [
        'operation-theatre-technology' => [
            'title' => 'B.Voc in Operation Theatre Technology',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science (PCB/PCM)',
            'seats' => 30,
            'overview' => 'Train as a skilled OT technician who assists surgeons during surgical procedures. Learn sterilisation, anaesthesia support, and patient care in a modern OT environment.',
            'career' => ['OT Technician', 'Scrub Technician', 'Anaesthesia Assistant', 'Hospital Administrator', 'ICU Technician'],
            'recruiters' => ['AIIMS', 'Fortis', 'Apollo', 'Max Healthcare', 'PGI Chandigarh', 'Civil Hospital'],
            'image' => 'courses/ot.jpg',
        ],
        'medical-lab-technology' => [
            'title' => 'B.Voc in Medical Lab Technology',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science (PCB)',
            'seats' => 30,
            'overview' => 'Become a qualified laboratory technician capable of conducting clinical tests that aid in diagnosis and treatment of diseases.',
            'career' => ['Lab Technician', 'Pathology Technician', 'Blood Bank Technician', 'Research Assistant', 'Lab Manager'],
            'recruiters' => ['SRL Diagnostics', 'Thyrocare', 'Dr Lal PathLabs', 'AIIMS', 'Govt. Hospitals'],
            'image' => 'courses/mlt.jpg',
        ],
        'ophthalmic-technology' => [
            'title' => 'B.Voc in Ophthalmic Technology',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science',
            'seats' => 20,
            'overview' => 'Specialise in assisting ophthalmologists in diagnosis and treatment of eye disorders using advanced ophthalmic equipment.',
            'career' => ['Ophthalmic Technician', 'Optometrist Assistant', 'Eye Bank Coordinator', 'Lasik Technician'],
            'recruiters' => ['Sankara Eye Hospital', 'Eye-Q', 'Dr Shroff', 'Vasan Eye Care'],
            'image' => 'courses/ophthalmic.jpg',
        ],
        'cardiac-care-technology' => [
            'title' => 'B.Voc in Cardiac Care Technology',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science (PCB)',
            'seats' => 20,
            'overview' => 'Learn to operate ECG machines, cardiac monitors, and assist cardiologists in catheterisation labs and ICUs.',
            'career' => ['Cardiac Technician', 'Cath Lab Technician', 'ICU Technician', 'ECG Technician', 'Perfusionist'],
            'recruiters' => ['Fortis Heart Institute', 'Max Cardiology', 'Asian Heart', 'Narayana Health'],
            'image' => 'courses/cardiac.jpg',
        ],
        'dialysis-technology' => [
            'title' => 'B.Voc in Dialysis Technology',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science',
            'seats' => 20,
            'overview' => 'Operate and maintain haemodialysis and peritoneal dialysis equipment for patients with chronic kidney disease.',
            'career' => ['Dialysis Technician', 'Renal Technician', 'Transplant Coordinator', 'ICU Specialist'],
            'recruiters' => ['Kidney Care Centres', 'Apollo Dialysis', 'NKF', 'Govt. Hospitals'],
            'image' => 'courses/dialysis.jpg',
        ],
        'radiology-imaging-technology' => [
            'title' => 'B.Voc in Radiology & Medical Imaging Technology',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science (PCB/PCM)',
            'seats' => 30,
            'overview' => 'Learn to operate X-ray, CT, MRI, and ultrasound equipment for diagnostic imaging in hospitals and diagnostic centres.',
            'career' => ['Radiographer', 'CT Technician', 'MRI Technician', 'Sonographer', 'Imaging Coordinator'],
            'recruiters' => ['Medanta', 'Apollo', 'GE Healthcare', 'Philips Medical', 'Govt. Hospitals'],
            'image' => 'courses/radiology.jpg',
        ],
        'hospital-management' => [
            'title' => 'B.Voc in Hospital Management',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 (Any Stream)',
            'seats' => 30,
            'overview' => 'Gain expertise in hospital administration, healthcare finance, HR management, and quality control in healthcare settings.',
            'career' => ['Hospital Administrator', 'Ward Manager', 'Healthcare Consultant', 'Medical Billing Executive'],
            'recruiters' => ['Max Healthcare', 'Fortis', 'Columbia Asia', 'Insurance Companies'],
            'image' => 'courses/hospital-mgmt.jpg',
        ],
        'physiotherapy' => [
            'title' => 'B.Voc in Physiotherapy',
            'badge' => 'B.Voc',
            'duration' => '3 Years',
            'eligibility' => '10+2 with Science (PCB)',
            'seats' => 20,
            'overview' => 'Learn rehabilitative techniques to help patients recover from injuries, surgeries, and chronic conditions through evidence-based physical therapy.',
            'career' => ['Physiotherapist', 'Sports Therapist', 'Rehab Specialist', 'Home Care Therapist'],
            'recruiters' => ['Fortis Rehab', 'Apollo', 'Sports Medicine Centres', 'Govt. Hospitals'],
            'image' => 'courses/physio.jpg',
        ],
    ];

    public function show(string $slug)
    {
        $course = self::$courses[$slug] ?? null;
        if (!$course)
            abort(404);

        /* Related courses — exclude current */
        $related = collect(self::$courses)
            ->except($slug)
            ->take(3)
            ->map(fn($c, $s) => array_merge($c, ['slug' => $s]))
            ->values();

        return view('pages.course', compact('course', 'slug', 'related'));
    }

    public static function all(): array
    {
        return self::$courses;
    }
}