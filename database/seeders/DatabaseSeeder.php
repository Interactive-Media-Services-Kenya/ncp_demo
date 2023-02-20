<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            FaqsTableSeeder::class,
            IndustriesTableSeeder::class,
            CompaniesTableSeeder::class,
            RegionsTableSeeder::class,
            RejectsTableSeeder::class,
            StorageTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            ValidpoolTableSeeder::class,
        ]);
    }
}
