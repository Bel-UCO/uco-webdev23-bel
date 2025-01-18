<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrentLandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePath = public_path('assets/NEW.jpg');

        if (file_exists($imagePath)) {
            $imageBlob = file_get_contents($imagePath); // Membaca file sebagai binary data

            DB::table('current_landing_pages')->insert([
                'image' => $imageBlob, // Simpan binary data ke kolom
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            echo "File $imagePath tidak ditemukan.\n";
        }
    }
}
