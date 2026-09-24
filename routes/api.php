<?php

use App\Http\Controllers\Api\V1\AdmissionApiController;
use App\Http\Controllers\Api\V1\ContactEnquiryApiController;
use App\Http\Controllers\Api\V1\EnquiryApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Read-only API for website form submissions (prefix: /api)
|--------------------------------------------------------------------------
| GET only — nothing here can create, edit or delete data.
| Every request needs a key from Admin → API Access (header X-API-KEY).
| Full list + examples: Admin → API Access.
*/

// API key check (ApiKeyAuth) is prepended to the whole "api" group in bootstrap/app.php
Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {
    Route::get('/admissions', [AdmissionApiController::class, 'index'])->name('admissions.index');
    Route::get('/admissions/{application}', [AdmissionApiController::class, 'show'])->whereNumber('application')->name('admissions.show');

    Route::get('/contact-enquiries', [ContactEnquiryApiController::class, 'index'])->name('contact-enquiries.index');
    Route::get('/contact-enquiries/{contactEnquiry}', [ContactEnquiryApiController::class, 'show'])->whereNumber('contactEnquiry')->name('contact-enquiries.show');

    Route::get('/enquiries', [EnquiryApiController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{enquiry}', [EnquiryApiController::class, 'show'])->whereNumber('enquiry')->name('enquiries.show');
});
