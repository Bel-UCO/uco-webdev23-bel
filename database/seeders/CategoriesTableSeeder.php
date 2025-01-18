<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Data kategori yang ingin ditambahkan
        $categories = [
            ['name' => 'Originals', 'order_no' => 1, 'image' => 'assets/1.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lifestyle', 'order_no' => 2, 'image' => 'assets/2.jpg','created_at' => now(), 'updated_at' => now()],
            ['name' => 'Running', 'order_no' => 3, 'image' => 'assets/3.jpg','created_at' => now(), 'updated_at' => now()],
            ['name' => 'Training', 'order_no' => 4, 'image' => 'assets/4.jpg','created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sportswear', 'order_no' => 5,'image' => 'assets/5.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Football', 'order_no' => 6,'image' => 'assets/6.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basketball', 'order_no' => 7,'image' => 'assets/7.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tennis', 'order_no' => 8,'image' => 'assets/8.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Golf', 'order_no' => 9,'image' => 'assets/9.jpg', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Menyimpan data kategori ke dalam tabel 'categories'
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
