<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ContactEnquiryResource;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;

class ContactEnquiryApiController extends ApiController
{
    public function index(Request $request)
    {
        $enquiries = $this->applyCommonFilters(ContactEnquiry::with(['courseCategory', 'course']), $request, ['name', 'phone', 'email'])
            ->when($request->filled('branch'), fn($q) => $q->where('branch', $request->branch))
            ->paginate($this->perPage($request))
            ->withQueryString();

        return ContactEnquiryResource::collection($enquiries);
    }

    public function show(ContactEnquiry $contactEnquiry)
    {
        return new ContactEnquiryResource($contactEnquiry->load(['courseCategory', 'course']));
    }
}
