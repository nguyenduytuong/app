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
            ]
        ];

        User::insert($users);
    }
}
