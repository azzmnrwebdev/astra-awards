<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Developer',
                'position' => 'Administrator',
                'phone_number' => '081234567890',
                'email' => 'developer@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
        ]);
    }
}
