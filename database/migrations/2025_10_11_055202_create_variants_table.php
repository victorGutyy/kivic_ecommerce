<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void {
Schema::create('variants', function (Blueprint $table) {
$table->id();
$table->foreignId('product_id')->constrained()->cascadeOnDelete();
$table->string('sku')->unique();
$table->string('size')->nullable(); // S, M, L
$table->string('color')->nullable(); // Rojo, Azul
$table->unsignedInteger('price'); // permite variar precio por talla/color
$table->unsignedInteger('stock')->default(0);
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('variants'); }
};