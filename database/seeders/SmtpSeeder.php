<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\SmtpSetting as Smtp;

class SmtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only create if it doesn't exist
        if (Smtp::count() == 0) {
            Smtp::create([
                'host' => 'mail.imranuzzaman.com',
                'port' => 587,
                'username' => 'contact@imranuzzaman.com',
                'password' => '}CyHBl!OXi1Z!=fH',
                'encryption' => 'tls',
                'from_address' => 'contact@imranuzzaman.com',
                'from_name' => 'Imran Uzzaman',
            ]);
        }
    }
}
