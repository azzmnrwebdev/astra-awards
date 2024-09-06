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
            ['name' => 'Otomotif'],
            ['name' => 'Alat Berat, Pertambangan, Konstruksi & Energi'],
            ['name' => 'Agribisnis'],
            ['name' => 'Infrastruktur dan Logistik'],
            ['name' => 'Properti'],
            ['name' => 'Head Office'],
            ['name' => 'Yayasan dan Koperasi'],
        ]);
    }
}
