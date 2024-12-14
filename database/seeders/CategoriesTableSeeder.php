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
            ['name' => 'Originals', 'order_no' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lifestyle', 'order_no' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Running', 'order_no' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Training', 'order_no' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sportswear', 'order_no' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Football', 'order_no' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basketball', 'order_no' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tennis', 'order_no' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Golf', 'order_no' => 9, 'created_at' => now(), 'updated_at' => now()],
        ];

        // Menyimpan data kategori ke dalam tabel 'categories'
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
