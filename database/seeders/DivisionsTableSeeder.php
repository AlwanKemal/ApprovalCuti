<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan divisi
        DB::table('divisions')->insert([
            ['name' => 'IT Department'],
            ['name' => 'HR Department'],
            ['name' => 'Finance Department'],
        ]);
    }
}
