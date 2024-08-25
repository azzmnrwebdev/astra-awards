<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('business_lines')->insert([
            ['name' => 'Jasa Keuangan'],
            ['name' => 'Teknologi Informasi'],
        ]);
    }
}
