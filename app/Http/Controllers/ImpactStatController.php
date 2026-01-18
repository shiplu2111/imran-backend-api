<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\Award;
use Illuminate\Http\JsonResponse;

class ImpactStatController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => [
                [
                    'label' => 'Publications',
                    'count' => Publication::count(),
                    'icon'  => 'BookOpen'
                ],
                [
                    'label' => 'Citations',
                    'count' => Publication::sum('citations'), // Sums the citations of all papers
                    'icon'  => 'Quote'
                ],
                [
                    'label' => 'Research Projects',
                    'count' => ResearchProject::count(),
                    'icon'  => 'Microscope'
                ],
                [
                    'label' => 'Awards',
                    'count' => Award::count(),
                    'icon'  => 'Trophy'
                ]
            ]
        ]);
    }
}
