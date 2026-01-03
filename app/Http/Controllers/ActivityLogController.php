<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Http\Resources\ActivityLogResource;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    // GET /api/admin/activity-logs
    public function index()
    {
        // Get latest 20 activities
        $logs = ActivityLog::latest()->take(20)->get();
        return ActivityLogResource::collection($logs);
    }
}
