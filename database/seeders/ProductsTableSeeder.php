<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Loop untuk membuat 30 produk
        for ($i = 0; $i < 30; $i++) {
            // Generate random product name with 2 to 4 words
            $productName = $faker->words(rand(2, 4), true); // Nama produk terdiri dari 2-4 kata

            // // Generate random image URLs
            $imageUrl1 = 'https://picsum.photos/350/350'; // Gambar pertama
            $imageUrl2 = 'https://picsum.photos/350/350'; // Gambar kedua
            $imageUrl3 = 'https://picsum.photos/350/350'; // Gambar ketiga

            // // Mendapatkan binary data dari URL gambar
            $image1 = $this->getImageBinary($imageUrl1);  // Gambar pertama
            $image2 = $this->getImageBinary($imageUrl2);  // Gambar kedua
            $image3 = $this->getImageBinary($imageUrl3);  // Gambar ketiga

            if (is_null($image1) || is_null($image2) || is_null($image3)) {
                Log::warning("One or more images failed to fetch for product: $productName");
            }

            // Insert produk ke dalam tabel 'products'
            DB::table('products')->insert([
                'name' => $productName,  // Nama produk acak (2-4 kata)
                'gender' => ['m', 'f', 'u', 'k'][rand(0, 3)],  // Gender acak
                'category_id' => rand(1, 9),  // ID kategori acak antara 1 dan 9
                'subcategory' => ['SHOES', 'SHIRT', 'T-SHIRT', 'SHORTS'][rand(0, 3)],  // Subkategori acak
                'price' => rand(500000, 3000000),  // Harga produk acak
                'discount' => rand(0, 50),  // Diskon acak
                'stock' => 200,
                'image1' => $image1,  // Gambar pertama sebagai binary
                'image2' => $image2,  // Gambar kedua sebagai binary
                'image3' => $image3,  // Gambar ketiga sebagai binary
                'description' => $faker->sentence(),  // Deskripsi produk acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Fungsi untuk mengambil gambar sebagai binary dari URL
    private function getImageBinary($url)
    {
        $maxRetries = 3; // Maximum number of retry attempts
        $retryDelay = 2; // Delay in seconds between retries

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                // Try fetching the image content
                return file_get_contents($url);
            } catch (\Exception $e) {
                // Log the error (optional)
                Log::warning("Attempt $attempt: Failed to fetch image from $url. Error: " . $e->getMessage());

                // If this is the last attempt, rethrow the exception
                if ($attempt === $maxRetries) {
                    return null;
                }

                // Wait before retrying
                sleep($retryDelay);
            }
        }

        // If all retries fail, return null as a fallback
        return null;
    }

}
