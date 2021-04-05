<?php

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
                'title' => 'hi_game_create',
            ],
            [
                'id'    => 18,
                'title' => 'hi_game_edit',
            ],
            [
                'id'    => 19,
                'title' => 'hi_game_show',
            ],
            [
                'id'    => 20,
                'title' => 'hi_game_delete',
            ],
            [
                'id'    => 21,
                'title' => 'hi_game_access',
            ],
            [
                'id'    => 22,
                'title' => 'event_access',
            ],
            [
                'id'    => 23,
                'title' => 'hi_venue_create',
            ],
            [
                'id'    => 24,
                'title' => 'hi_venue_edit',
            ],
            [
                'id'    => 25,
                'title' => 'hi_venue_show',
            ],
            [
                'id'    => 26,
                'title' => 'hi_venue_delete',
            ],
            [
                'id'    => 27,
                'title' => 'hi_venue_access',
            ],
            [
                'id'    => 28,
                'title' => 'hi_event_create',
            ],
            [
                'id'    => 29,
                'title' => 'hi_event_edit',
            ],
            [
                'id'    => 30,
                'title' => 'hi_event_show',
            ],
            [
                'id'    => 31,
                'title' => 'hi_event_delete',
            ],
            [
                'id'    => 32,
                'title' => 'hi_event_access',
            ],
            [
                'id'    => 33,
                'title' => 'hi_event_info_create',
            ],
            [
                'id'    => 34,
                'title' => 'hi_event_info_edit',
            ],
            [
                'id'    => 35,
                'title' => 'hi_event_info_show',
            ],
            [
                'id'    => 36,
                'title' => 'hi_event_info_delete',
            ],
            [
                'id'    => 37,
                'title' => 'hi_event_info_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
