<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['name' => 'Nanggroe Aceh Darussalam'],
            ['name' => 'Sumatera Utara'],
            ['name' => 'Sumatera Selatan'],
            ['name' => 'Sumatera Barat'],
            ['name' => 'Bengkulu'],
            ['name' => 'Riau'],
            ['name' => 'Kepulauan Riau'],
            ['name' => 'Jambi'],
            ['name' => 'Lampung'],
            ['name' => 'Bangka Belitung'],
            ['name' => 'Kalimantan Barat'],
            ['name' => 'Kalimantan Timur'],
            ['name' => 'Kalimantan Selatan'],
            ['name' => 'Kalimantan Tengah'],
            ['name' => 'Kalimantan Utara'],
            ['name' => 'Banten'],
            ['name' => 'DKI Jakarta'],
            ['name' => 'Jawa Barat'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'Jawa Timur'],
            ['name' => 'Daerah Istimewa Yogyakarta'],
            ['name' => 'Bali'],
            ['name' => 'Nusa Tenggara Timur'],
            ['name' => 'Nusa Tenggara Barat'],
            ['name' => 'Gorontalo'],
            ['name' => 'Sulawesi Barat'],
            ['name' => 'Sulawesi Tengah'],
            ['name' => 'Sulawesi Utara'],
            ['name' => 'Sulawesi Tenggara'],
            ['name' => 'Sulawesi Selatan'],
            ['name' => 'Maluku Utara'],
            ['name' => 'Maluku'],
            ['name' => 'Papua'],
            ['name' => 'Papua Barat'],
            ['name' => 'Papua Tengah'],
            ['name' => 'Papua Pegunungan'],
            ['name' => 'Papua Selatan'],
            ['name' => 'Papua Barat Daya'],
        ]);
    }
}
