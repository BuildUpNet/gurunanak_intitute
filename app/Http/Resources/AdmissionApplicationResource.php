<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'candidate_name'      => $this->candidate_name,
            'course_name'         => $this->course_name,
            'gender'              => $this->gender,
            'category'            => $this->category,
            'category_other'      => $this->category_other,
            'dob'                 => $this->dob?->format('Y-m-d'),
            'place_of_birth'      => $this->place_of_birth,
            'aadhaar_no'          => $this->aadhaar_no,
            'nationality'         => $this->nationality,
            'country_citizenship' => $this->country_citizenship,
            'permanent_address'   => $this->permanent_address,
            'mobile'              => $this->mobile,
            'email'               => $this->email,
            'status'              => $this->status,
            'submitted_at'        => $this->created_at?->toIso8601String(),
        ];
    }
}
