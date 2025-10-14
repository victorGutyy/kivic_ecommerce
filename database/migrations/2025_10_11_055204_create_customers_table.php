<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void {
Schema::create('customers', function (Blueprint $table) {
$table->engine = 'InnoDB';
$table->id();
$table->foreignId('store_id')->constrained()->cascadeOnDelete();
$table->string('name');
$table->string('email')->nullable();
$table->string('phone')->nullable();
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('customers'); }
};