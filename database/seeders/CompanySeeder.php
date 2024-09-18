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
            [
                'name' => 'Acset Indonusa Tbk',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Advics Manufacturing Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Agro Menara Rachmat',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Agro Nusa Abadi (ANA)',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astragraphia Tbk',
                'parent_company_id' =>  1,
                'business_line_id' => 2,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Akashi Wahana Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Akebono Brake Astra Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Tunggal Perkasa Plantation (TPP)',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Agro Lestari 1',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Sedaya Finance',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Daihatsu Motor - Karawang Assy Plant',
                'parent_company_id' =>  6,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Daihatsu Motor - Engine Plant',
                'parent_company_id' =>  6,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Daihatsu Motor - Casting Plant',
                'parent_company_id' =>  6,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Daihatsu Motor - Head Office',
                'parent_company_id' =>  6,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Daihatsu Motor - Parts Center',
                'parent_company_id' =>  6,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Daihatsu Motor - Sunter Assy Plants',
                'parent_company_id' =>  6,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant 2 Pegangsaan',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant 3 Cikarang',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant 3A Cikarang',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant 4 Karawang',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant 5 Karawang',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant DMD',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant PQE',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant TSD',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Plant PC',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Honda Motor - Head Office (Plant 1)',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk -  Honda Sales Operation (HSO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk -   Astraworld (AWSO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk - Head Office',
                'parent_company_id' =>  10,
                'business_line_id' => 8,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk - Toyota Sales Operations (TSO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk -  Daihatsu Sales Operations (DSO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk - BMW Sales Operations (BSO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk - UD Trucks Sales Operations (UD SO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra International Tbk - Isuzu Sales Operations (ISO)',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Juoku Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Komponen Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Nippon Gasket Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Otoparts Tbk - Head Office',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Otoparts - Divisi Nusa Metal',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Tol Nusantara',
                'parent_company_id' =>  10,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Autoplastik Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Bhadra Cemerlang',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Bhadra Sukses',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Borneo Indah Marjaya',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Cakung Permata Nusa',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Century Batteries Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Chuhatsu Indonesia',
                'parent_company_id' =>  12,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Cipta Agro Nusantara',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Denso Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'DIC Astra Chemicals',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Ekadura Indonesia',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Evoluzione Tyres',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Federal Izumi Manufacturing',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Federal Nittan Industries',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Gaya Motor',
                'parent_company_id' =>  10,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Gemala Kempa Daya',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'GS Battery',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Gunung Sejahtera Dua Indah',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Gunung Sejahtera Ibu Pertiwi',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Gunung Sejahtera Puti Pesona',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Gunung Sejahtera Yoli Makmur',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Indonesia Nippon Seiki',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Inti Ganda Perdana',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Inti Pantja Press Industries',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Isuzu Astra Motor Indonesia',
                'parent_company_id' =>  15,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Kalimantan Prima Persada',
                'parent_company_id' =>  8,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Karya Tanah Subur',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Karyanusa Eka Daya',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Kayaba Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Kimia Tirta Utama',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Komatsu Marketing and Support Indonesia (KMSI)',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Komatsu Indonesia',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Komatsu Reman Asia',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Koperasi Astra International',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Lestari Tani Teladan',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            ['name' => 'Letawa', 'parent_company_id' =>  3, 'business_line_id' => 5, 'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())],
            [
                'name' => 'Lintas Marga Sedaya',
                'parent_company_id' =>  9,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            ['name' => 'Mamuang', 'parent_company_id' =>  3, 'business_line_id' => 5, 'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())],
            [
                'name' => 'Marga Harjaya Infrastruktur',
                'parent_company_id' =>  9,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Marga Mandalasakti',
                'parent_company_id' =>  7,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Nirmala Agro Lestari',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Nusa Keihin Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Palma Plantasindo',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Pamapersada Nusantara',
                'parent_company_id' =>  8,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Pasangkayu',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Perkebunan Lembah Bhakti',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Perkebunan Lembah Bhakti 2',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Persada Bina Nusantara Abadi',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Persada Dinamika Lestari',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astratech',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Samadista karya',
                'parent_company_id' =>  17,
                'business_line_id' => 7,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Tokai Toyota Auto Body Extrusion',
                'parent_company_id' =>  12,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Serasi Autoraya',
                'parent_company_id' =>  14,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Resin Plating Technology',
                'parent_company_id' =>  12,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Rimbunan Alam Sentosa',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sari Aditya Loka 1',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sari Aditya Loka 2',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sari Lembah Subur',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sawit Asahan Indah',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Showa Indonesia Manufacturing',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'SKF Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Subur Abadi Plantations',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Subur Agro Makmur',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sugity Creatives',
                'parent_company_id' =>  12,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sukses Tani Nusasubur',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sumber Kharisma Persada',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Surya Indah Nusantara Pagi',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Suryaraya Lestari 1',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Suryaraya Lestari 2',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Suryaraya Rubberindo Industries',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Tanjung Sarana Lestari',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'TD Automotive Compressor Indonesia',
                'parent_company_id' =>  12,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Tjahja Sakti Motor',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Topy Palingda',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Toyota Astra Motor',
                'parent_company_id' =>  13,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Toyota Motor Manufacturing Indonesia',
                'parent_company_id' =>  12,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'TRAC Astra Rent Car',
                'parent_company_id' =>  14,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Traktor Nusantara',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Tribuana Mas',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Tunggal Perkasa Plantations',
                'parent_company_id' =>  3,
                'business_line_id' => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'United Tractors',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Amaliah Astra',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yutaka Manufacturing Indonesia',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Hitachi Astemo',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'AT Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Aisin Indonesia',
                'parent_company_id' =>  4,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Digital Internasional',
                'parent_company_id' =>  10,
                'business_line_id' => 2,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Fuji Technica Indonesia',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Pulogadung Pawitra Laksana',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Federal International Finance',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Asuransi Jiwa Astra',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Mitra Ventura',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Multi Finance',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Asuransi Astra Buana',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Cipta Sedaya Digital Indonesia',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sedaya Multi Investama',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Toyota Astra Financial Services',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Menara Astra',
                'parent_company_id' =>  17,
                'business_line_id' => 7,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Brahmayasa Bahtera',
                'parent_company_id' =>  17,
                'business_line_id' => 7,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Astra Digital Mobil (OLXmobbi)',
                'parent_company_id' =>  14,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Surya Arta Nusantara Finance (SANF)',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Komatsu Astra Finance',
                'parent_company_id' =>  5,
                'business_line_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Serasi Mitra Mobil',
                'parent_company_id' =>  14,
                'business_line_id' => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Pakoakuina',
                'parent_company_id' =>  18,
                'business_line_id' => 3,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Harmoni Mitra Utama',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'United Tractors Pandu Engeneering',
                'parent_company_id' =>  2,
                'business_line_id' => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Insan Mulia Pama',
                'parent_company_id' =>  8,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Sigap Prima Astrea',
                'parent_company_id' =>  19,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Dharma Bhakti Astra (YDBA)',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Pendidikan Astra-Michael D. Ruslim (YPA-MDR)',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Astra Honda Motor (YAHM)',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Toyota dan Astra (YTA)',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Karya Bakti United Tractors (YKBUT)',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'Yayasan Astra Agro Lestari (YAAL)',
                'parent_company_id' =>  10,
                'business_line_id' => 9,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
        ]);
    }
}
