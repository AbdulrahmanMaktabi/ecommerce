<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@site.com',
                'password' => bcrypt('secret'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Vendor User',
                'username' => 'vendor',
                'email' => 'vendor@site.com',
                'password' => bcrypt('secret'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            [
                'name' => 'User User',
                'username' => 'user',
                'email' => 'user@site.com',
                'password' => bcrypt('secret'),
                'role' => 'user',
                'status' => 'active',
            ]
        ]);
    }
}
