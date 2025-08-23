<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->default('Tanpa Judul');
            $table->string('penulis')->default('-');
            $table->string('deskripsi')->default('-');
            $table->decimal('harga', 10, 2)->default(0);
            $table->integer('stok')->default(0);
            $table->string('foto')->nullable();
            $table->integer('halaman')->nullable();
            // $table->string('bahasa')->default('Indonesia');
            $table->decimal('panjang', 5, 2)->nullable();
            $table->decimal('lebar', 5, 2)->nullable();
            $table->decimal('berat', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
