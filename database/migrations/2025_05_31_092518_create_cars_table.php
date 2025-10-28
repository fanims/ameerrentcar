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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_type');
            $table->string('category');
            $table->string('name');
            $table->string('brand');
            $table->string('model_year');

            // Pricing (base + current for each period)
            $table->string('base_price_per_hour')->nullable();
            $table->string('current_price_per_hour')->nullable();
            $table->string('base_price_per_day')->nullable();
            $table->string('current_price_per_day')->nullable();
            $table->string('base_price_per_week')->nullable();
            $table->string('current_price_per_week')->nullable();
            $table->string('base_price_per_month')->nullable();
            $table->string('current_price_per_month')->nullable();

            $table->string('persons_can_sit');
            $table->string('seats_available');
            $table->json('interior_colors')->nullable();
            $table->json('exterior_colors')->nullable();
            $table->string('thumbnail_image');
            $table->text('description');
            $table->string('short_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
