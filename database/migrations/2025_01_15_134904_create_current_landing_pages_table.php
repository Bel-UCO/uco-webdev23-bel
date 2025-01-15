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
        Schema::create('current_landing_pages', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE current_landing_pages MODIFY image LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_landing_pages');
    }
};
