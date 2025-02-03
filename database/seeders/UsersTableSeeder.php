<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin', 
                'division_id' => 2,
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user', 
                'division_id' => 1,
            ],
            [
                'name' => 'Approver 1',
                'email' => 'approver1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'approver1', 
                'division_id' => 1,
            ],
            [
                'name' => 'Approver 2',
                'email' => 'approver2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'approver2', 
                'division_id' => 1,
            ],
            [
                'name' => 'Approver1 Finance',
                'email' => 'approver1Finance@example.com',
                'password' => Hash::make('password123'),
                'role' => 'approver1', 
                'division_id' => 3,
            ],
            [
                'name' => 'Approver2 Finance',
                'email' => 'approver2Finance@example.com',
                'password' => Hash::make('password123'),
                'role' => 'approver2', 
                'division_id' => 3,
            ],
        ]);
    }
}
