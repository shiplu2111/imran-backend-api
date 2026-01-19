<?php

namespace Database\Seeders;

use App\Models\CareerJourney;
use Illuminate\Database\Seeder;

class CareerJourneySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'icon' => 'User',
                'year' => '2024',
                'title' => 'Graduate Research Excellence Award',
                'description' => 'Recognized for outstanding research contributions',
                'sort_order' => 1
            ],
            [
                'icon' => 'Email',
                'year' => '2023',
                'title' => 'Started MS in Sustainable Agriculture',
                'description' => 'Lincoln University of Missouri, USA',
                'sort_order' => 2
            ],
            [
                'icon' => null,

                'year' => '2022',
                'title' => 'Best Research Paper Award',
                'description' => 'Bangladesh Veterinary Association',
                'sort_order' => 3
            ],
            [
                'year' => '2020',
                'title' => 'Completed MS in Pharmacology',
                'description' => 'Bangladesh Agricultural University',
                'sort_order' => 4
            ],
            [
                'year' => '2017',
                'title' => 'Doctor of Veterinary Medicine',
                'description' => 'Started career as Veterinary Officer',
                'sort_order' => 5
            ],
        ];

        foreach ($data as $item) {
            CareerJourney::create($item);
        }
    }
}
