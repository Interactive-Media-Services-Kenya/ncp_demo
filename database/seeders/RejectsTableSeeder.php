<?php

namespace Database\Seeders;

use App\Models\Reject;
use Illuminate\Database\Seeder;

class RejectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rejects = [
            [
                'id' => 1,
                'reason' => 'Draw Rerun',
            ],
            [
                'id' => 2,
                'reason' => 'Reason 2',
            ],
            [
                'id' => 3,
                'reason' => 'Reason 3',
            ],
        ];

        Reject::insert($rejects);
    }
}
