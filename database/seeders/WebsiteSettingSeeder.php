<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run()
    {
        // Only create if it doesn't exist
        if (WebsiteSetting::count() == 0) {
            WebsiteSetting::create([
                'site_name' => 'Imran Foundation',
                'logo_type' => 'text',
                'logo_text' => 'IMRANUZZAMAN',
                'primary_email' => 'contact@example.com',
                'footer_text' => '© 2025 All Rights Reserved.',
                'email_notifications' => true,
                'fund_applications_alerts' => true,
                'message_alerts' => true,
                'maintenance_mode' => false,
                'consultancy_alerts' => true,
            ]);
        }
    }
}
