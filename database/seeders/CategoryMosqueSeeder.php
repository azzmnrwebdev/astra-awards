<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryMosqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_mosques')->insert([
            ['name' => 'Masjid Besar', 'description' => "Kapasitas lebih dari 500 jamaah, dan melaksanakan sholat jum'at."],
            ['name' => 'Masjid Sedang', 'description' => "Kapasitas kurang dari 500 jamaah, dan melaksanakan sholat jum'at."],
            ['name' => 'Mushala', 'description' => "Hanya digunakan sholat rawatib, tidak digunakan sholat jum'at."],
        ]);
    }
}
