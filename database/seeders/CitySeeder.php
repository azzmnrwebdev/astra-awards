<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Barat Daya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Besar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Jaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Singkil',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Tamiang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Tenggara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Aceh Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Bener Meriah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Bireuen',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Gayo Lues',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Nagan Raya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Pidie',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Pidie Jaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kabupaten Simeulue',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kota Banda Aceh',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kota Lhokseumawe',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kota Sabang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 1,
                'name' => 'Kota Subulussalam',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Asahan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Batu Bara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Dairi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Deli Serdang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Humbang Hasundutan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Karo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Labuhanbatu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Labuhanbatu Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Labuhanbatu Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Langkat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Mandailing Natal',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Nias',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Nias Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Nias Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Nias Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Padang Lawas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Padang Lawas Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Pakpak Bharat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Samosir',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Serdang Bedagai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Simalungun',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Tapanuli Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Tapanuli Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Tapanuli Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kabupaten Toba',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Binjai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Gunungsitoli',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Medan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Padangsidimpuan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Pematangsiantar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Sibolga',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Tanjungbalai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 2,
                'name' => 'Kota Tebing Tinggi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Banyuasin',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Empat Lawang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Lahat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Muara Enim',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Musi Banyuasin',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Musi Rawas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Musi Rawas Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Ogan Ilir',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Ogan Komering Ilir',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Ogan Komering Ulu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Ogan Komering Ulu Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Ogan Komering Ulu Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kabupaten Penukal Abab Lematang Ilir',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kota Lubuk Linggau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kota Pagaralam',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kota Palembang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 3,
                'name' => 'Kota Prabumulih',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Agam',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Dharmasraya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Kepulauan Mentawai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Lima Puluh Kota',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Padang Pariaman',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Pasaman',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Pasaman Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Pesisir Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Sijunjung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Solok',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Solok Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kabupaten Tanah Datar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Bukittinggi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Padang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Padang Panjang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Pariaman',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Payakumbuh',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Sawahlunto',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 4,
                'name' => 'Kota Solok',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Bengkulu Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Bengkulu Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Bengkulu Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Kaur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Kepahiang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Lebong',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Mukomuko',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Rejang Lebong',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kabupaten Seluma',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 5,
                'name' => 'Kota Bengkulu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Bengkalis',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Indragiri Hilir',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Indragiri Hulu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Kampar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Kepulauan Meranti',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Kuantan Singingi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Pelalawan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Rokan Hulu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kabupaten Siak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kota Dumai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 6,
                'name' => 'Kota Pekanbaru',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kabupaten Bintan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kabupaten Karimun',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kabupaten Kepulauan Anambas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kabupaten Lingga',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kabupaten Natuna',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kota Batam',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 7,
                'name' => 'Kota Tanjungpinang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Batanghari',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Bungo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Kerinci',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Merangin',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Muaro Jambi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Sarolangun',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Tanjung Jabung Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Tanjung Jabung Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kabupaten Tebo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kota Jambi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 8,
                'name' => 'Kota Sungai Penuh',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Lampung Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Lampung Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Lampung Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Lampung Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Lampung Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Mesuji',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Pesawaran',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Pesisir Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Pringsewu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Tanggamus',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Tulang Bawang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Tulang Bawang Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kabupaten Way Kanan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kota Bandar Lampung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 9,
                'name' => 'Kota Metro',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kabupaten Bangka',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kabupaten Bangka Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kabupaten Bangka Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kabupaten Bangka Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kabupaten Belitung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kabupaten Belitung Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 10,
                'name' => 'Kota Pangkalpinang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Bengkayang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Kapuas Hulu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Kayong Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Ketapang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Kubu Raya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Landak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Melawi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Mempawah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Sambas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Sekadau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kabupaten Sintang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kota Pontianak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 11,
                'name' => 'Kota Singkawang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Berau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Kutai Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Kutai Kartanegara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Kutai Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Mahakam Ulu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Paser',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kabupaten Penajam Paser Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kota Balikpapan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kota Bontang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 12,
                'name' => 'Kota Samarinda',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Balangan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Banjar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Barito Kuala',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Hulu Sungai Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Hulu Sungai Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Kotabaru',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Tabalong',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Tanah Bumbu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kabupaten Tanah Laut',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kota Banjarbaru',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 13,
                'name' => 'Kota Banjarmasin',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Barito Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Barito Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Barito Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Gunung Mas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Kapuas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Katingan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Kotawaringin Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Kotawaringin Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Lamandau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Murung Raya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Pulang Pisau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Seruyan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kabupaten Sukamara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 14,
                'name' => 'Kota Palangkaraya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 15,
                'name' => 'Kabupaten Bulungan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 15,
                'name' => 'Kabupaten Malinau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 15,
                'name' => 'Kabupaten Nunukan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 15,
                'name' => 'Kabupaten Tana Tidung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 15,
                'name' => 'Kota Tarakan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kabupaten Lebak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kabupaten Pandeglang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kabupaten Serang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kabupaten Tangerang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kota Cilegon',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kota Serang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kota Tangerang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 16,
                'name' => 'Kota Tangerang Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 17,
                'name' => 'Kabupaten Administrasi Kepulauan Seribu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 17,
                'name' => 'Kota Administrasi Jakarta Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 17,
                'name' => 'Kota Administrasi Jakarta Pusat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 17,
                'name' => 'Kota Administrasi Jakarta Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 17,
                'name' => 'Kota Administrasi Jakarta Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 17,
                'name' => 'Kota Administrasi Jakarta Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Bandung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Bandung Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Bekasi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Bogor',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Ciamis',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Cianjur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Cirebon',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Garut',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Indramayu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Karawang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Kuningan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Majalengka',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Pangandaran',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Purwakarta',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Subang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Sukabumi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Sumedang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kabupaten Tasikmalaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Bandung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Banjar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Bekasi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Bogor',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Cimahi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Cirebon',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Depok',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Sukabumi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 18,
                'name' => 'Kota Tasikmalaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Banjarnegara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Banyumas',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Batang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Blora',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Boyolali',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Brebes',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Cilacap',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Demak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Grobogan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Jepara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Karanganyar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Kebumen',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Kendal',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Klaten',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Kudus',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Magelang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Pati',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Pekalongan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Pemalang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Purbalingga',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Purworejo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Rembang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Semarang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Sragen',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Sukoharjo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Tegal',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Temanggung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Wonogiri',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kabupaten Wonosobo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kota Magelang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kota Pekalongan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kota Salatiga',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kota Semarang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kota Surakarta',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 19,
                'name' => 'Kota Tegal',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Bangkalan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Banyuwangi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Blitar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Bojonegoro',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Bondowoso',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Gresik',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Jember',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Jombang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Kediri',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Lamongan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Lumajang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Madiun',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Magetan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Malang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Mojokerto',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Nganjuk',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Ngawi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Pacitan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Pamekasan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Pasuruan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Ponorogo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Probolinggo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Sampang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Sidoarjo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Situbondo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Sumenep',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Trenggalek',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Tuban',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kabupaten Tulungagung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Batu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Blitar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Kediri',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Madiun',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Malang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Mojokerto',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Pasuruan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Probolinggo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 20,
                'name' => 'Kota Surabaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 21,
                'name' => 'Kabupaten Bantul',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 21,
                'name' => 'Kabupaten Gunungkidul',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 21,
                'name' => 'Kabupaten Kulon Progo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 21,
                'name' => 'Kabupaten Sleman',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 21,
                'name' => 'Kota Yogyakarta',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Badung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Bangli',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Buleleng',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Gianyar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Jembrana',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Karangasem',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Klungkung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kabupaten Tabanan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 22,
                'name' => 'Kota Denpasar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Alor',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Belu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Ende',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Flores Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Kupang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Lembata',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Malaka',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Manggarai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Manggarai Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Manggarai Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Nagekeo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Ngada',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Rote Ndao',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Sabu Raijua',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Sikka',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Sumba Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Sumba Barat Daya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Sumba Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Sumba Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Timor Tengah Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kabupaten Timor Tengah Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 23,
                'name' => 'Kota Kupang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Bima',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Dompu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Lombok Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Lombok Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Lombok Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Lombok Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Sumbawa',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kabupaten Sumbawa Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kota Bima',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 24,
                'name' => 'Kota Mataram',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Boalemo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Bone Bolango',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Gorontalo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Gorontalo Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Pohuwato',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kota Gorontalo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Majene',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Mamasa',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Mamuju',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Mamuju Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Pasangkayu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 25,
                'name' => 'Kabupaten Polewali Mandar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Banggai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Banggai Kepulauan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Banggai Laut',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Buol',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Donggala',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Morowali',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Morowali Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Parigi Moutong',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Poso',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Sigi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Tojo Una-Una',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kabupaten Tolitoli',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 26,
                'name' => 'Kota Palu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Bolaang Mongondow',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Bolaang Mongondow Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Bolaang Mongondow Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Bolaang Mongondow Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Kepulauan Sangihe',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Kepulauan Siau Tagulandang Biaro',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Kepulauan Talaud',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Minahasa',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Minahasa Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Minahasa Tenggara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kabupaten Minahasa Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kota Bitung',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kota Kotamobagu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kota Manado',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 27,
                'name' => 'Kota Tomohon',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Bombana',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Buton',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Buton Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Buton Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Buton Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Kolaka',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Kolaka Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Kolaka Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Konawe',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Konawe Kepulauan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Konawe Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Konawe Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Muna',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Muna Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kabupaten Wakatobi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kota Baubau',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 28,
                'name' => 'Kota Kendari',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Bantaeng',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Barru',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Bone',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Bulukumba',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Enrekang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Gowa',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Jeneponto',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Kepulauan Selayar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Luwu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Luwu Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Luwu Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Maros',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Pangkajene dan Kepulauan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Pinrang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Sidenreng Rappang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Sinjai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Soppeng',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Takalar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Tana Toraja',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Toraja Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kabupaten Wajo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kota Makassar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kota Palopo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 29,
                'name' => 'Kota Parepare',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Halmahera Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Halmahera Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Halmahera Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Halmahera Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Halmahera Utara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Kepulauan Sula',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Pulau Morotai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kabupaten Pulau Taliabu',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kota Ternate',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 30,
                'name' => 'Kota Tidore Kepulauan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Buru',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Buru Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Kepulauan Aru',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Kepulauan Tanimbar',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Maluku Barat Daya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Maluku Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Maluku Tenggara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Seram Bagian Barat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kabupaten Seram Bagian Timur',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kota Ambon',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 31,
                'name' => 'Kota Tual',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Biak Numfor',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Jayapura',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Keerom',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Kepulauan Yapen',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Mamberamo Raya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Sarmi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Supiori',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kabupaten Waropen',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 32,
                'name' => 'Kota Jayapura',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Fakfak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Kaimana',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Manokwari',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Manokwari Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Pegunungan Arfak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Teluk Bintuni',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 33,
                'name' => 'Kabupaten Teluk Wondama',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Deiyai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Intan Jaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Mimika',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Nabire',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Paniai',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Puncak',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 34,
                'name' => 'Kabupaten Puncak Jaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Jayawijaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Lanny Jaya',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Mamberamo Tengah',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Nduga',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Pegunungan Bintang',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Tolikara',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Yalimo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 35,
                'name' => 'Kabupaten Yahukimo',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 36,
                'name' => 'Kabupaten Asmat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 36,
                'name' => 'Kabupaten Boven Digoel',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 36,
                'name' => 'Kabupaten Mappi',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 36,
                'name' => 'Kabupaten Merauke',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 37,
                'name' => 'Kabupaten Maybrat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 37,
                'name' => 'Kabupaten Raja Ampat',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 37,
                'name' => 'Kabupaten Sorong',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 37,
                'name' => 'Kabupaten Sorong Selatan',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 37,
                'name' => 'Kabupaten Tambrauw',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'province_id' => 37,
                'name' => 'Kota Sorong',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
        ]);
    }
}
