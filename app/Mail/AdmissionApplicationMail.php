<?php

namespace App\Mail;

use App\Models\AdmissionApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(AdmissionApplication $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('New Admission Application - ' . $this->application->candidate_name)
            ->view('emails.admission-application');
    }
}