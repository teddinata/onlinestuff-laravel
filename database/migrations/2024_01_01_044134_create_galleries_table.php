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
        Schema::create('galleries', function (Blueprint $table) {
            // generate gallery table
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('image')->nullable();
            $table->string('caption')->nullable();
            $table->boolean('is_default')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('is_thumbnail')->nullable();

            // soft delete
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            // drop table
            Schema::dropIfExists('galleries');
        });
    }
};
