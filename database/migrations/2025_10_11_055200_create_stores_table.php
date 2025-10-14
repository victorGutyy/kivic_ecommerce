<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void {
Schema::create('stores', function (Blueprint $table) {
$table->engine = 'InnoDB';
$table->id();
$table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
$table->string('name');
$table->string('slug')->unique();
$table->string('country')->nullable();
$table->string('currency', 3)->default('COP');
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('stores'); }
};
