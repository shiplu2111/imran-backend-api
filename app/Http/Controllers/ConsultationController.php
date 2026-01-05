<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Resources\ConsultationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ConsultationController extends Controller
{
    // PROTECTED (Admin): List all
   // PROTECTED (Admin): List all with Filter
    public function index(Request $request)
    {
        // Start the query
        $query = Consultation::latest();

        // Check if 'type' is present in the URL (e.g. ?type=Ruminants)
        if ($request->has('type') && $request->type != null) {
            $query->where('type', $request->type);
        }

        // Execute query
        $consultations = $query->get();

        return ConsultationResource::collection($consultations);
    }

    // PUBLIC: Submit Request
    public function store(StoreConsultationRequest $request)
    {
        $consultation = Consultation::create($request->validated());
        ActivityLog::log(
                'New Consultation Request',
                "{$consultation->full_name} requested a {$consultation->type} consultation",
                'consultation' // Type for icon/filtering
            );
        // Optional: Send Email Notification here

        return new ConsultationResource($consultation);
    }

    // PROTECTED: Show
    public function show(Consultation $consultation)
    {
        return new ConsultationResource($consultation);
    }

    // PROTECTED: Delete
    public function destroy(Consultation $consultation): JsonResponse
    {
        $consultation->delete();
        return response()->json(['message' => 'Consultation deleted successfully']);
    }

    // ==========================================
    // SPECIAL ROUTES FOR STATUS UPDATES
    // ==========================================

    /**
     * Update Consultation Status (pending -> confirmed -> completed)
     */
    public function updateStatus(Request $request, Consultation $consultation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $consultation->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => new ConsultationResource($consultation)
        ]);
    }

    /**
     * Update Payment Status (unpaid -> paid)
     */
    public function updatePaymentStatus(Request $request, Consultation $consultation)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,paid,refunded'
        ]);

        $consultation->update(['payment_status' => $request->payment_status]);

        return response()->json([
            'message' => 'Payment status updated successfully',
            'data' => new ConsultationResource($consultation)
        ]);
    }
}
