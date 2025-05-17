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
            $table->string('slug')->unique()->nullable();
            $table->string('description')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->decimal('price_PEN');
            $table->decimal('price_USD');
            $table->integer('stock')->default(1);
            $table->integer('number_of_days')->nullable();
            $table->integer('number_of_nights')->nullable();
            $table->integer('number_of_people')->nullable()->default(1);
            $table->string('file')->nullable();
            $table->text('itinerary')->nullable();
            $table->text('reservation_requirements')->nullable();
            $table->text('reservation_included')->nullable();
            $table->foreignId('destino_id')->constrained('destinos')->onDelete('cascade');
            $table->boolean('visible_in_main_web')->nullable()->default(false);
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
