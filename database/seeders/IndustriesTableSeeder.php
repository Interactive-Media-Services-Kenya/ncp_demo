<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industries = [
            [
                'id'    => 1,
                'title' => 'Technology',
            ],
            [
                'id'    => 2,
                'title' => 'Agriculture',
            ],
            [
                'id'    => 3,
                'title' => 'Medical and HealthCare',
            ],
            [
                'id'    => 4,
                'title' => 'Logistics',
            ],
            [
                'id'    => 5,
                'title' => 'Fashion and Design',
            ],
            [
                'id'    => 6,
                'title' => 'Hospitality',
            ],
            [
                'id'    => 7,
                'title' => 'other',
            ],
        ];

        Industry::insert($industries);
    }
}
