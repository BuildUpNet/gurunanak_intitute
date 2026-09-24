<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\EnquiryResource;
use App\Models\Enquiry;
use Illuminate\Http\Request;

/** Quick Admission Enquiries (home page + admissions page form) */
class EnquiryApiController extends ApiController
{
    public function index(Request $request)
    {
        $enquiries = $this->applyCommonFilters(Enquiry::with(['courseCategory', 'course']), $request, ['name', 'phone', 'email'])
            ->when($request->filled('branch'), fn($q) => $q->where('branch', $request->branch))
            ->paginate($this->perPage($request))
            ->withQueryString();

        return EnquiryResource::collection($enquiries);
    }

    public function show(Enquiry $enquiry)
    {
        return new EnquiryResource($enquiry->load(['courseCategory', 'course']));
    }
}
