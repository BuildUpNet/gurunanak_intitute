<?php

namespace App\Http\Controllers;

use App\Models\ProgramDetail;
use Illuminate\Http\Request;

class ProgramDetailController extends Controller
{
    public function show(string $slug)
    {
        $program = ProgramDetail::where('slug', $slug)
            ->where('status', 1)
            ->with(['opportunities', 'levels.category', 'heroBadges', 'glanceItems', 'careerRoles', 'graduatesWork', 'faqs'])
            ->firstOrFail();

        return view('pages.program-detail', [
            'program'       => $program,
            'opportunities' => $program->opportunities,
        ]);
    }
}
