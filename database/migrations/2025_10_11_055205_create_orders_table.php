<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void {
Schema::create('orders', function (Blueprint $table) {
$table->engine = 'InnoDB';
$table->id();
$table->foreignId('store_id')->constrained()->cascadeOnDelete();
$table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
$table->string('status')->default('new'); // new, paid, shipped, delivered
$table->unsignedInteger('subtotal')->default(0);
$table->unsignedInteger('shipping')->default(0);
$table->unsignedInteger('total')->default(0);
$table->string('payment_status')->default('pending'); // pending, paid, failed
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('orders'); }
};
