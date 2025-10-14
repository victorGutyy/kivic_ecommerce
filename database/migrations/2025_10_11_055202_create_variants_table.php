<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id'); // = unsigned BIGINT
            $table->unsignedBigInteger('product_id'); // tipo idéntico al de products.id
            $table->string('sku')->unique();
            $table->string('size')->nullable();  // S, M, L
            $table->string('color')->nullable(); // Rojo, Azul
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();

            // FK explícita (a veces es más robusta en MariaDB)
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
