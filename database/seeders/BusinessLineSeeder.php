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
            ['name' => 'Nusantara Agrofood'],
            ['name' => 'Sumber Energi Terbarukan'],
            ['name' => 'Jaya Konstruksi Indonesia'],
            ['name' => 'Sentra Telekomunikasi Nusantara'],
            ['name' => 'Sejahtera Retail Indonesia'],
            ['name' => 'Bintang E-commerce Solutions'],
            ['name' => 'Samudra Logistik Asia'],
            ['name' => 'Griya Properti Nusantara'],
            ['name' => 'Prima Asuransi Indonesia'],
            ['name' => 'Bumi Petrokimia Sentosa'],
        ]);
    }
}
