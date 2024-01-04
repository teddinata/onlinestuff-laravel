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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            // transaction id
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('product_id');
            // $table->foreignId('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            // $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            // product id

            $table->integer('price')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('total_amount')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
