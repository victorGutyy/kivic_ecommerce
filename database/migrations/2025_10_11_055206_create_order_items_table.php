<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void {
Schema::create('order_items', function (Blueprint $table) {
$table->engine = 'InnoDB';
$table->id();
$table->foreignId('order_id')->constrained()->cascadeOnDelete();
$table->foreignId('product_id')->constrained()->cascadeOnDelete();
$table->foreignId('variant_id')->nullable()->constrained()->nullOnDelete();
$table->unsignedInteger('qty');
$table->unsignedInteger('unit_price');
$table->unsignedInteger('line_total');
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('order_items'); }
};