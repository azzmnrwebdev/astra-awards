<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            ['name' => 'PT. Agro Makmur Nusantara', 'parent_company_id' => 1, 'business_line_id' => 1],
            ['name' => 'PT. Surya Tani Sentosa', 'parent_company_id' => 1, 'business_line_id' => 1],
            ['name' => 'PT. Surya Energi Indonesia', 'parent_company_id' => 2, 'business_line_id' => 2],
            ['name' => 'PT. Bumi Energi Hijau', 'parent_company_id' => 2, 'business_line_id' => 2],
            ['name' => 'PT. Karya Pembangunan Jaya', 'parent_company_id' => 3, 'business_line_id' => 3],
            ['name' => 'PT. Nusantara Konstruksi Mandiri', 'parent_company_id' => 3, 'business_line_id' => 3],
            ['name' => 'PT. Telkom Global Nusantara', 'parent_company_id' => 4, 'business_line_id' => 4],
            ['name' => 'PT. Nusantara Digital Telekom', 'parent_company_id' => 4, 'business_line_id' => 4],
            ['name' => 'PT. Retail Sentosa Indonesia', 'parent_company_id' => 5, 'business_line_id' => 5],
            ['name' => 'PT. Sejahtera Perdagangan Nusantara', 'parent_company_id' => 5, 'business_line_id' => 5],
            ['name' => 'PT. E-commerce Solusi Digital', 'parent_company_id' => 6, 'business_line_id' => 6],
            ['name' => 'PT. Nusantara Teknologi Terpadu', 'parent_company_id' => 6, 'business_line_id' => 6],
            ['name' => 'PT. Samudra Logistik Nusantara', 'parent_company_id' => 7, 'business_line_id' => 7],
            ['name' => 'PT. Transportasi Samudra Utama', 'parent_company_id' => 7, 'business_line_id' => 7],
            ['name' => 'PT. Griya Sejahtera Indonesia', 'parent_company_id' => 8, 'business_line_id' => 8],
            ['name' => 'PT. Properti Nusantara Sentosa', 'parent_company_id' => 8, 'business_line_id' => 8],
            ['name' => 'PT. Sejahtera Proteksi Nusantara', 'parent_company_id' => 9, 'business_line_id' => 9],
            ['name' => 'PT. Nusantara Asuransi Jaya', 'parent_company_id' => 9, 'business_line_id' => 9],
            ['name' => 'PT. Kimia Bumi Sentosa', 'parent_company_id' => 10, 'business_line_id' => 10],
            ['name' => 'PT. Nusantara Kimia Utama', 'parent_company_id' => 10, 'business_line_id' => 10],
        ]);
    }
}
