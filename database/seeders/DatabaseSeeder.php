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
        User::factory()->create([
            'name'  => 'Developer',
            'username' => 'ShipLuJS',
            'email' => self::DEVELOPER_EMAIL,
            'password' => Hash::make('password'),
        ]);
    }
}
