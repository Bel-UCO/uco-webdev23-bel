<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['m','f','u','k'])->default('m');
            $table->string('category_id');
            $table->string('subcategory');
            $table->integer('price');
            $table->integer('discount');
            $table->text('image1');  // Ganti dengan text jika kolom ini berisi data besar (untuk LONGBLOB)
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Menggunakan raw SQL untuk mengubah kolom image menjadi LONGBLOB
        DB::statement('ALTER TABLE products MODIFY image1 LONGBLOB');
        DB::statement('ALTER TABLE products MODIFY image2 LONGBLOB');
        DB::statement('ALTER TABLE products MODIFY image3 LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
