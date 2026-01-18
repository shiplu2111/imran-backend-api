<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Publication;
use App\Models\Award;
use Illuminate\Http\JsonResponse;

class HighlightController extends Controller
{
    public function index(): JsonResponse
    {
        // 1. Get Latest Education (or Current)
        $education = Education::where('currently_pursuing', true)->first()
                     ?? Education::latest('start_date')->first();

        // 2. Get Current Position
        $position = Experience::where('is_current', true)->first()
                    ?? Experience::latest('start_date')->first();

        // 3. Get Publication Stats
        $pubCount = Publication::count();

        // 4. Get Latest Award
        $award = Award::latest('year')->first(); // Assuming 'year' is stored as string/date

        return response()->json([
            'data' => [
                'education' => [
                    'title'       => 'Education',
                    'degree'      => $education ? $education->degree : 'No Degree Listed',
                    'institution' => $education ? $education->institution : '',
                    'icon'        => 'GraduationCap'
                ],
                'position' => [
                    'title'       => 'Current Position',
                    'role'        => $position ? $position->role : 'Available for Work',
                    'institution' => $position ? $position->organization : '',
                    'icon'        => 'Briefcase'
                ],
                'publications' => [
                    'title'       => 'Publications',
                    'main_text'   => "{$pubCount} Peer-Reviewed Papers",
                    'sub_text'    => 'Multiple preprints and conference papers', // Static or you can add a setting for this
                    'icon'        => 'FileText'
                ],
                'recognition' => [
                    'title'       => 'Recognition',
                    'award'       => $award ? $award->title : 'No Awards Yet',
                    'institution' => $award ? $award->organization : '',
                    'icon'        => 'Award'
                ]
            ]
        ]);
    }
}
