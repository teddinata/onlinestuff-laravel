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
        Schema::table('products', function (Blueprint $table) {
            // add: video_url string 1000 nullable
            $table->string('video_url', 1000)->nullable()->after('tags');
            // add: discount
            $table->integer('discount_price')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // drop: video_url
            $table->dropColumn('video_url');
            // drop: discount
            $table->dropColumn('discount_price');
        });
    }
};
