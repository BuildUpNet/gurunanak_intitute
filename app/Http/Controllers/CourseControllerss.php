<?php
// app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\ProgramDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseControllerss extends Controller
{
    /**
     * Departments/Programs merge: courses now live under /programs/{slug}.
     * This old route 301-redirects so existing bookmarks/links keep working.
     */
    public function show(string $slug)
    {
        $program = ProgramDetail::where('slug', $slug)->where('status', 1)->first();
        if ($program) {
            return redirect()->route('program.show', $program->slug, 301);
        }

        $course = Course::where('slug', $slug)->first();
        if ($course) {
            $matched = ProgramDetail::where('title', $course->title)->where('status', 1)->first();
            if ($matched) {
                return redirect()->route('program.show', $matched->slug, 301);
            }
        }

        abort(404);
    }
}
