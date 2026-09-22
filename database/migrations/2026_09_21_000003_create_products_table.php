<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->unsignedTinyInteger('spiciness_level')->default(0); // 0 to 5
            $table->boolean('is_crispy')->default(false);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_signature')->default(false);
            $table->string('image_url')->nullable();
            $table->string('type')->default('food'); // food, beverage, side, packaged_sambal
            $table->integer('stock')->default(100);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
