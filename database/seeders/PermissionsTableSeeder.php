<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'sport_create',
            ],
            [
                'id'    => 19,
                'title' => 'sport_edit',
            ],
            [
                'id'    => 20,
                'title' => 'sport_show',
            ],
            [
                'id'    => 21,
                'title' => 'sport_delete',
            ],
            [
                'id'    => 22,
                'title' => 'sport_access',
            ],
            [
                'id'    => 23,
                'title' => 'team_create',
            ],
            [
                'id'    => 24,
                'title' => 'team_edit',
            ],
            [
                'id'    => 25,
                'title' => 'team_show',
            ],
            [
                'id'    => 26,
                'title' => 'team_delete',
            ],
            [
                'id'    => 27,
                'title' => 'team_access',
            ],
            [
                'id'    => 28,
                'title' => 'country_create',
            ],
            [
                'id'    => 29,
                'title' => 'country_edit',
            ],
            [
                'id'    => 30,
                'title' => 'country_show',
            ],
            [
                'id'    => 31,
                'title' => 'country_delete',
            ],
            [
                'id'    => 32,
                'title' => 'country_access',
            ],
            [
                'id'    => 33,
                'title' => 'event_create',
            ],
            [
                'id'    => 34,
                'title' => 'event_edit',
            ],
            [
                'id'    => 35,
                'title' => 'event_show',
            ],
            [
                'id'    => 36,
                'title' => 'event_delete',
            ],
            [
                'id'    => 37,
                'title' => 'event_access',
            ],
            [
                'id'    => 38,
                'title' => 'content_access',
            ],
            [
                'id'    => 39,
                'title' => 'system_access',
            ],
            [
                'id' => 40,
                'title' => 'currency_access'
            ],
            [
                'id' => 41,
                'title' => 'currency_create'
            ],
            [
                'id' => 42,
                'title' => 'currency_edit'
            ],
            [
                'id' => 43,
                'title' => 'currency_show'
            ],
            [
                'id' => 44,
                'title' => 'currency_delete'
            ],
            [
                'id'    => 45,
                'title' => 'event_management_access',
            ],
            [
                'id'    => 46,
                'title' => 'booking_management_access',
            ],
            [
                'id'    => 47,
                'title' => 'announcement_access',
            ],
        ];

        DB::table('permissions')->upsert($permissions, 'title');
    }
}
