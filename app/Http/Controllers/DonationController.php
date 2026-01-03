<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Http\Resources\DonationResource;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    // GET (Public)
    public function index()
    {
        return DonationResource::collection(Donation::latest()->get());
    }

    // GET Total (Public)
    public function total()
    {
        $total = Donation::where('status', 'completed')->sum('amount');
        return response()->json([
            'total_amount' => $total,
            'currency' => 'USD'
        ]);
    }

    // POST (Protected)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|string',
            'date' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:completed,pending,failed',
        ]);

        if (empty($validated['date'])) {
            $validated['date'] = now()->format('Y-m-d');
        }
        if (empty($validated['status'])) {
            $validated['status'] = 'pending';
        }

        $donation = Donation::create($validated);

        // ✅ Added Message Response
        return response()->json([
            'message' => 'Donation added successfully!',
            'data' => new DonationResource($donation)
        ], 201);
    }

    // GET Single (Public)
    public function show(Donation $donation)
    {
        return new DonationResource($donation);
    }

    // PUT (Protected)
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'donor' => 'string',
            'amount' => 'numeric',
            'status' => 'in:completed,pending,failed',
            'date' => 'date',
            'email' => 'email',
            'notes' => 'string',
            'method' => 'string'
        ]);

        $donation->update($validated);

        // ✅ Added Message Response
        return response()->json([
            'message' => 'Donation updated successfully!',
            'data' => new DonationResource($donation)
        ]);
    }

    // DELETE (Protected)
    public function destroy(Donation $donation)
    {
        $donation->delete();

        // ✅ Added Message Response
        return response()->json([
            'message' => 'Donation deleted successfully!'
        ]);
    }
}
