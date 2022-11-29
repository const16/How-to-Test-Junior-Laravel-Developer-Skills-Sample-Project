<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Adminitrator',
                'email'          => 'admin@email.com',
                'password'       => bcrypt('password'),
                'is_admin'       => 1,
                'remember_token' => null,
                'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id'             => 2,
                'name'           => 'User',
                'email'          => 'user@email.com',
                'password'       => bcrypt('password'),
                'is_admin'       => 0,
                'remember_token' => null,
                'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'     => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        User::insert($users);
    }
}
