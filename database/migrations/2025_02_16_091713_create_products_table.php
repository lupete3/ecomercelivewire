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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->longText('long_description')->nullable();
            $table->decimal('regular_price');
            $table->decimal('sale_price');
            $table->unsignedInteger('quantity')->default(100);
            $table->string('image');
            $table->longText('images')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
