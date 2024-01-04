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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // user id
            // $table->unsignedBigInteger('user_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            // data diri pembeli
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address', 1000)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('regency_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('invoice_code')->unique()->nullable();
            $table->integer('insurance_price')->nullable();
            $table->integer('shipping_price')->nullable();
            $table->string('estimated_arrival')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('resi')->nullable();
            $table->string('courier')->nullable();
            $table->string('courier_service')->nullable();
            $table->enum('payment_method', ['cod', 'paypal', 'bank_transfer'])->default('bank_transfer')->nullable();
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending')->nullable();
            $table->enum('shipping_status', ['packing', 'ready_to_ship', 'on_delivery_courier', 'delivered'])->default('packing')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
