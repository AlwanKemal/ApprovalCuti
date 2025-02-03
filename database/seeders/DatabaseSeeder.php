<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DivisionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
