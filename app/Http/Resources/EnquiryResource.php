<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** Quick Admission Enquiry (home page + admissions page form) */
class EnquiryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'phone'           => $this->phone,
            'email'           => $this->email,
            'branch'          => $this->branch,
            'course_category' => $this->courseCategory?->title,
            'course'          => $this->getRelationValue('course')?->title ?? $this->getAttribute('course'),
            'message'         => $this->message,
            'submitted_at'    => $this->created_at?->toIso8601String(),
        ];
    }
}
