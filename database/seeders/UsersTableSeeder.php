<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 2,
                'name'           => 'xx',
                'email'          => 'xx@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 3,
                'name'           => 'bb',
                'email'          => 'bb@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 4,
                'name'           => 'cc',
                'email'          => 'cc@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 5,
                'name'           => 'dd',
                'email'          => 'dd@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 6,
                'name'           => 'ff',
                'email'          => 'ff@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 7,
                'name'           => 'gg',
                'email'          => 'gg@admin.com',
                'password'       => bcrypt('password'),
            ],
            [
                'id'             => 8,
                'name'           => 'hh',
                'email'          => 'hh@admin.com',
                'password'       => bcrypt('password'),
            ],[
                'id'             => 9,
                'name'           => 'yy',
                'email'          => 'yy@admin.com',
                'password'       => bcrypt('password'),
            ],[
                'id'             => 10,
                'name'           => 'kk',
                'email'          => 'kk@admin.com',
                'password'       => bcrypt('password'),
            ],[
                'id'             => 11,
                'name'           => 'll',
                'email'          => 'll@admin.com',
                'password'       => bcrypt('password'),
            ],[
                'id'             => 12,
                'name'           => 'rr',
                'email'          => 'rr@admin.com',
                'password'       => bcrypt('password'),
            ]
        ];

        User::insert($users);
    }
}
