<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Satu user hanya punya satu cart
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // Schema::create('cart_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('cart_id');
        //     $table->unsignedBigInteger('product_id');
        //     $table->integer('quantity')->default(1);
        //     $table->decimal('price', 10, 2); // Tambahkan kolom price
        //     $table->timestamps();

        //     $table->foreign('cart_id')
        //         ->references('id')
        //         ->on('carts')
        //         ->onDelete('cascade');

        //     $table->foreign('product_id')
        //         ->references('id')
        //         ->on('products')
        //         ->onDelete('cascade');
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
}
