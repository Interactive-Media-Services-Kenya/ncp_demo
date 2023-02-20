<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $regions = [
            [
                'id'    => 1,
                'title' => 'Nairobi',
            ],
            [
                'id'    => 2,
                'title' => 'Nyanza',
            ],
            [
                'id'    => 3,
                'title' => 'Central',
            ],
            [
                'id'    => 4,
                'title' => 'Coast',
            ],
            [
                'id'    => 5,
                'title' => 'Rift Valley',
            ],
            [
                'id'    => 6,
                'title' => 'Western',
            ],
            [
                'id'    => 7,
                'title' => 'North Eastern',
            ],
            [
                'id'    => 8,
                'title' => 'Eastern',
            ],
        ];

        Region::insert($regions);
    }
}
