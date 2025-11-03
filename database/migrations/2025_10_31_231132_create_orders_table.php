<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('reference')->unique();          // ref interna para pago
            $table->string('status')->default('pending');   // pending|paid|cancelled|failed

            // Datos cliente simples (MVP)
            $table->string('customer_name')->nullable();
            $table->string('email')->nullable();

            // Totales en centavos
            $table->unsignedBigInteger('subtotal_cents')->default(0);
            $table->unsignedBigInteger('tax_cents')->default(0);
            $table->unsignedBigInteger('shipping_cents')->default(0);
            $table->unsignedBigInteger('total_cents')->default(0);
            $table->string('currency', 3)->default('COP');

            // Pago
            $table->string('payment_gateway')->nullable(); // epayco
            $table->string('payment_ref')->nullable();     // ref del gateway
            $table->timestamp('paid_at')->nullable();
            $table->json('payment_payload')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
