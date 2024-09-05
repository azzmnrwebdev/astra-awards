<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parent_companies')->insert([
            ['name' => 'PT. Indo Tani Sejahtera'],
            ['name' => 'PT. Mega Energi Nusantara'],
            ['name' => 'PT. Mandiri Pembangunan Global'],
            ['name' => 'PT. Global Telekomunikasi Abadi'],
            ['name' => 'PT. Utama Perdagangan Sejahtera'],
            ['name' => 'PT. Digital Teknologi Nusantara'],
            ['name' => 'PT. Asia Pasifik Transportasi'],
            ['name' => 'PT. Pembangunan Properti Sejahtera'],
            ['name' => 'PT. Nusantara Finansial Jaya'],
            ['name' => 'PT. Kimia Industri Indonesia'],
        ]);
    }
}
