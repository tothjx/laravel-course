<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_zip');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_zip');
            $table->enum('shipping_method', ['házhoz szállítás', 'boltban átvétel']);
            $table->enum('payment_method', ['készpénz', 'bankkártya']);
            $table->decimal('total_amount', 10, 2);
            $table->json('items');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
