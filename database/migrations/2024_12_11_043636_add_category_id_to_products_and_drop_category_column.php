<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambahkan kolom 'category_id' sebagai foreign key
            $table->unsignedBigInteger('category_id')->after('gender'); // Sesuaikan posisi jika diperlukan

            // Menambahkan foreign key yang menghubungkan 'category_id' di 'products' dengan 'id' di 'categories'
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Menghapus kolom 'category'
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus foreign key dan kolom 'category_id'
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // Menambahkan kembali kolom 'category' jika diperlukan
            $table->string('category')->after('gender'); // Sesuaikan posisi jika diperlukan
        });
    }
};
