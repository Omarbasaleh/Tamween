<?php

use App\User;
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
                'password'       => '$2y$10$UA6uznfCFKM0iVNiigLDdOHrZN6Ef7mCv/9Ol9ZBok2fQ.P7VDUim',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
