<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'settings_access',
            ],
            [
                'id'    => 18,
                'title' => 'profile_password_edit',
            ],
            [
                'id' => 19,
                'title'=> 'faq_access'
            ],
            [
                'id' => 20,
                'title'=> 'faq_create'
            ],
            [
                'id' => 21,
                'title'=> 'faq_edit'
            ],
            [
                'id' => 22,
                'title'=> 'faq_show'
            ],
            [
                'id' => 23,
                'title'=> 'faq_delete'
            ],
            [
                'id' => 24,
                'title'=> 'company_access'
            ],
            [
                'id' => 25,
                'title'=> 'company_create'
            ],
            [
                'id' => 26,
                'title'=> 'company_edit'
            ],
            [
                'id' => 27,
                'title'=> 'company_show'
            ],
            [
                'id' => 28,
                'title'=> 'company_delete'
            ],
            [
                'id' => 29,
                'title'=> 'industry_access'
            ],
            [
                'id' => 30,
                'title'=> 'industry_create'
            ],
            [
                'id' => 31,
                'title'=> 'industry_edit'
            ],
            [
                'id' => 32,
                'title'=> 'industry_show'
            ],
            [
                'id' => 33,
                'title'=> 'industry_delete'
            ],
            [
                'id' => 34,
                'title'=> 'complaint_access'
            ],
            [
                'id' => 35,
                'title'=> 'complaint_create'
            ],
            [
                'id' => 36,
                'title'=> 'complaint_edit'
            ],
            [
                'id' => 37,
                'title'=> 'complaint_show'
            ],
            [
                'id' => 38,
                'title'=> 'complaint_delete'
            ],
            [
                'id' => 39,
                'title'=> 'draw_access'
            ],
            [
                'id' => 40,
                'title'=> 'draw_create'
            ],
            [
                'id' => 41,
                'title'=> 'draw_edit'
            ],
            [
                'id' => 43,
                'title'=> 'draw_show'
            ],
            [
                'id' => 44,
                'title'=> 'draw_delete'
            ],
            [
                'id' => 45,
                'title'=> 'product_access'
            ],
            [
                'id' => 46,
                'title'=> 'product_create'
            ],
            [
                'id' => 47,
                'title'=> 'product_edit'
            ],
            [
                'id' => 48,
                'title'=> 'product_show'
            ],
            [
                'id' => 49,
                'title'=> 'product_delete'
            ],
        ];

        Permission::insert($permissions);
    }
}
