<?php

namespace App\Http\Controllers;

use App\Models\FoundationDonation;
use App\Http\Requests\StoreFoundationDonationRequest;
use App\Http\Requests\UpdateFoundationDonationRequest;
use Illuminate\Http\Request;

class FoundationDonationController extends Controller
{
    // --- PUBLIC: Frontend Website Data ---
    public function publicPage()
    {
        $methods = FoundationDonation::where('status', '!=', 'inactive')
            ->orderBy('sort_order', 'asc')
            ->get();

        return response()->json([
            'page_content' => [
                'hero_title' => 'Support Our Mission',
                'hero_subtitle' => 'Your donation helps us fund research, scholarships, and community development programs.',
                'about_title' => 'About Imran Foundation',
                'about_text' => 'The Imran Foundation is dedicated to supporting research and education in sustainable agriculture and veterinary sciences.',
                'transparency_title' => 'Secure & Transparent',
                'transparency_text' => 'All donations are processed securely. We maintain full transparency.',
            ],
            'donation_methods' => $methods
        ]);
    }

    // --- ADMIN CRUD ---
    public function index()
    {
        return FoundationDonation::orderBy('sort_order', 'asc')->get();
    }

    public function store(StoreFoundationDonationRequest $request)
    {
        $method = FoundationDonation::create($request->validated());
        return response()->json(['message' => 'Method created', 'data' => $method], 201);
    }

    public function show(FoundationDonation $foundationDonation)
    {
        return $foundationDonation;
    }

    public function update(UpdateFoundationDonationRequest $request, FoundationDonation $foundationDonation)
    {
        $foundationDonation->update($request->validated());
        return response()->json(['message' => 'Method updated', 'data' => $foundationDonation]);
    }

    public function destroy(FoundationDonation $foundationDonation)
    {
        $foundationDonation->delete();
        return response()->json(['message' => 'Method deleted successfully']);
    }
}
