<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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

            // Generate random image URLs
            $imageUrl1 = 'https://picsum.photos/350/350'; // Gambar pertama
            $imageUrl2 = 'https://picsum.photos/350/350'; // Gambar kedua
            $imageUrl3 = 'https://picsum.photos/350/350'; // Gambar ketiga

            // Mendapatkan binary data dari URL gambar
            $image1 = $this->getImageBinary($imageUrl1);  // Gambar pertama
            $image2 = $this->getImageBinary($imageUrl2);  // Gambar kedua
            $image3 = $this->getImageBinary($imageUrl3);  // Gambar ketiga

            // Insert produk ke dalam tabel 'products'
            DB::table('products')->insert([
                'name' => $productName,  // Nama produk acak (2-4 kata)
                'gender' => ['m', 'f', 'u', 'k'][rand(0, 3)],  // Gender acak
                'category_id' => rand(1, 9),  // ID kategori acak antara 1 dan 9
                'subcategory' => ['SHOES', 'SHIRT', 'T-SHIRT', 'SHORTS'][rand(0, 3)],  // Subkategori acak
                'price' => rand(500000, 3000000),  // Harga produk acak
                'discount' => rand(0, 50),  // Diskon acak
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
        // Mendapatkan gambar dari URL dan mengembalikannya sebagai binary
        return file_get_contents($url);
    }
}
