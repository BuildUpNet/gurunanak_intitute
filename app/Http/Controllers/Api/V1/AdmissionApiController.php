<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\AdmissionApplicationResource;
use App\Models\AdmissionApplication;
use Illuminate\Http\Request;

class AdmissionApiController extends ApiController
{
    public function index(Request $request)
    {
        $applications = $this->applyCommonFilters(AdmissionApplication::query(), $request, ['candidate_name', 'mobile', 'email'])
            ->when($request->filled('course_name'), fn($q) => $q->where('course_name', $request->course_name))
            ->paginate($this->perPage($request))
            ->withQueryString();

        return AdmissionApplicationResource::collection($applications);
    }

    public function show(AdmissionApplication $application)
    {
        return new AdmissionApplicationResource($application);
    }
}
