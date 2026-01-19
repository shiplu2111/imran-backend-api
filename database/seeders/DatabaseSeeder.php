<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public const DEVELOPER_EMAIL = 'me@shiplujs.com';

    public function run(): void
    {

       $this->call([
        PersonalInfoSeeder::class,
        WebsiteSettingSeeder::class,
        FoundationDonationSeeder::class,
        CareerJourneySeeder::class,
        SmtpSeeder::class,
    ]);
    }
}
