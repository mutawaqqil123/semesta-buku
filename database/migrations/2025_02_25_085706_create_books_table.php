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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('token_book', 16);
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->year('year')->nullable();
            // $table->decimal('daily_rate', 10, 2); // Tarif per hari
            $table->string('file_url'); // Link atau lokasi file e-book
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
