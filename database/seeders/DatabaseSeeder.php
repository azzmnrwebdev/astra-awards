<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategoryAreaSeeder::class,
            CategoryMosqueSeeder::class,
            ParentCompanySeeder::class,
            BusinessLineSeeder::class,
            CompanySeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
        ]);
    }
}
