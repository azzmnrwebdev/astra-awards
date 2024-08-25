<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_areas')->insert([
            ['name' => 'Area Site'],
            ['name' => 'Area Pabrik'],
            ['name' => 'Area Kantor Pusat & Cabang'],
        ]);
    }
}
