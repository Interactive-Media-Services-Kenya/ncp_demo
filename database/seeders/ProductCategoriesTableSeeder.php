<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCategories = [
            [
                'id'=> 1,
                'name'=> 'Airtime',
            ],
            [
                'id'=> 2,
                'name'=> 'Tshirts',
            ],
            [
                'id'=> 3,
                'name'=> 'Hoodies',
            ],
            [
                'id'=> 4,
                'name'=> 'Umbrellas',
            ],
            [
                'id'=> 5,
                'name'=> 'Bags',
            ],
        ];
        ProductCategory::insert($productCategories);
    }
}
