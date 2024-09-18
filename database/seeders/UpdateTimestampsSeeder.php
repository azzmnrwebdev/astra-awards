<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateTimestampsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now()->toDateTimeString();

        DB::table('users')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('category_areas')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('category_mosques')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('parent_companies')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('business_lines')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('companies')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('provinces')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);

        DB::table('cities')
            ->whereNull('created_at')
            ->orWhereNull('updated_at')
            ->update([
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);
    }
}
