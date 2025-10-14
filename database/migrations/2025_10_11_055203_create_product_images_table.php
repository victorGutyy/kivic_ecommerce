<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void {
Schema::create('product_images', function (Blueprint $table) {
$table->engine = 'InnoDB';
$table->id();
$table->foreignId('product_id')->constrained()->cascadeOnDelete();
$table->string('url');
$table->unsignedSmallInteger('position')->default(1);
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('product_images'); }
};