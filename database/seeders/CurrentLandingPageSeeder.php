<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrentLandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert a single record into the current_landing_pages table
        DB::table('current_landing_pages')->insert([
            'image' => 'assets/NEW.jpg' // Path to the new landing page asset
        ]);
    }
}
