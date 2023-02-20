<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [];
        $count = 0;
        for ($i=0; $i < 10; $i++) {

            $count +=1;
            $data = [
                'name' => 'Company '.$count,
                'email'=> 'company'.$count.'@company'.$count.'.com',
                'phone' => mt_rand(254700000000,254799999999),
                'industry_id' => mt_rand(1,7),
                'city' => 'Nairobi'
            ];
            array_push($companies,$data);
        }
        Company::insert($companies);
    }
}
