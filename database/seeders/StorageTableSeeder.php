<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Seeder;

class StorageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storages = [];
        $count = 0;
        for ($i=0; $i < 10; $i++) {

            $count +=1;
            $data = [
                'id' => $count,
                'name'=> 'Storage '.$count,
                'company_id' => mt_rand(1,10),

            ];
            array_push($storages,$data);
        }

        Storage::insert($storages);
    }
}
