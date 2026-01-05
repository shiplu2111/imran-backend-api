<?php

namespace App\Http\Controllers;

use App\Models\FundApplication;
use App\Models\ActivityLog;
use App\Http\Requests\StoreFundApplicationRequest;
use App\Http\Resources\FundApplicationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FundedIndividualResource;

class FundApplicationController extends Controller
{
    // PROTECTED (Admin): List all applications
    public function index()
    {
        return FundApplicationResource::collection(FundApplication::latest()->get());
    }

    // PUBLIC: Submit Application
    public function store(StoreFundApplicationRequest $request)
    {
        $data = $request->validated();

        // 1. Handle Document Upload (PDF/DOC)
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('fund_documents', $filename, 'public');
            $data['document'] = $path;
        }

        // 2. Create Record
        $application = FundApplication::create($data);

        // 3. Log Activity
        ActivityLog::log(
            'New Fund Application',
            "{$application->full_name} applied for {$application->support_type}",
            'fund'
        );

        return new FundApplicationResource($application);
    }

    // PROTECTED: Show Single
    public function show(FundApplication $fundApplication)
    {
        return new FundApplicationResource($fundApplication);
    }

    // PROTECTED: Update Status (Approve/Reject)
    public function updateStatus(Request $request, FundApplication $fundApplication)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected'
        ]);

        $fundApplication->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Application status updated successfully',
            'data' => new FundApplicationResource($fundApplication)
        ]);
    }

    // PROTECTED: Delete
    public function destroy(FundApplication $fundApplication): JsonResponse
    {
        // Delete document if exists
        if ($fundApplication->document && Storage::disk('public')->exists($fundApplication->document)) {
            Storage::disk('public')->delete($fundApplication->document);
        }

        $fundApplication->delete();
        return response()->json(['message' => 'Application deleted successfully']);
    }

    public function funded()
    {
        // 1. Filter only 'approved' status
        $approvedApps = FundApplication::where('status', 'approved')
            ->latest() // Show newest first
            ->get();

        // 2. Return using the public-safe resource
        return FundedIndividualResource::collection($approvedApps);
    }
}
