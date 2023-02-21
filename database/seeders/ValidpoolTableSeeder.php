<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ValidpoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating Fake Seed Data for April 1000 records per day
        $startDate = '2023-02-01';
        $endDate = '2023-02-28';

        $period =\Carbon\CarbonPeriod::create($startDate, $endDate)->toArray();

        $dates =[];
        foreach ($period as $date) {
            $date= $date->format('Y-m-d');
            array_push($dates,$date);
        }

        foreach ($dates as $validPoolDate) {
            $count = mt_rand(500,1000);
            for ($i=0; $i < $count; $i++) {
                $code = $this->generateCode();
                DB::table('validpool')->insert([
                    'validcode' => $code,
                    'phonenumber' => '2547'.mt_rand(10000000,99999999),
                    'date_created' => $validPoolDate.' '.mt_rand(1,23).':'.mt_rand(1,59).':00',
                    'won'=>0,
                ]);

            }
        }

    }
    public function generateCode()
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($permitted_chars), 0, 7);
        return $code;
    }
}
