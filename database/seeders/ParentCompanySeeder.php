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
            ['id' => 2, 'name' =>  'PT. United Tractors  Tbk'],
            ['id' => 3, 'name' =>  'PT Astra Agro Lestari Tbk'],
            ['id' => 1, 'name' =>  'PT. Astragraphia Tbk'],
            ['id' => 4, 'name' =>  'PT Astra Otoparts Tbk'],
            ['id' => 5, 'name' =>  'Astra Financial'],
            ['id' => 6, 'name' =>  'PT Astra Daihatsu Motor'],
            ['id' => 7, 'name' =>  'PT Astra Infra Toll Road'],
            ['id' => 8, 'name' =>  'PT. Pamapersada Nusantara'],
            ['id' => 9, 'name' =>  'PT Astra Tol Nusantara'],
            ['id' => 10, 'name' =>  'PT Astra International Tbk'],
            ['id' => 12, 'name' =>  'PT Toyota Motor Manufacturing Indonesia'],
            ['id' => 13, 'name' =>  'PT Toyota Astra Motor'],
            ['id' => 14, 'name' =>  'PT. Serasi Autoraya (SERA)'],
            ['id' => 15, 'name' =>  'PT Astra Honda Motor'],
            ['id' => 16, 'name' =>  'Head Office'],
            ['id' => 17, 'name' =>  'Astra Property'],
            ['id' => 18, 'name' =>  'PT Astra Motor'],
            ['id' => 19, 'name' =>  'Koperasi Astra International'],
        ]);
    }
}
