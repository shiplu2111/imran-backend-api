<?php

namespace Database\Seeders;

use App\Models\FoundationDonation;
use Illuminate\Database\Seeder;

class FoundationDonationSeeder extends Seeder
{
    public function run()
    {
        FoundationDonation::insert([
            [
                'name' => 'Credit/Debit Card',
                'description' => 'Secure payment via Stripe',
                'provider_id' => 'stripe',
                'status' => 'coming_soon',
                'sort_order' => 1
            ],
            [
                'name' => 'PayPal',
                'description' => 'International payments accepted',
                'provider_id' => 'paypal',
                'status' => 'coming_soon',
                'sort_order' => 2
            ],
            [
                'name' => 'Bank Transfer',
                'description' => 'A/C: 123456789, Bank: ABC Bank, SWIFT: ABCD123456, Branch: Main Branch (Bank), Address: 123 Main St, City, Country',
                'provider_id' => 'bank',
                'status' => 'coming_soon',
                'sort_order' => 3
            ],

            [
                'name' => 'Bkash Payment',
                'description' => 'Make payments via Bkash mobile banking to 0123456789',
                'provider_id' => 'bkash',
                'status' => 'coming_soon',
                'sort_order' => 4
            ],
        ]);

    }
}
