<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g. full_fuel, child_seat, booster_seat, additional_driver, young_driver, senior_driver
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('icon')->default('ti-plus');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency', 8)->default('EUR');
            $table->enum('pricing_type', ['flat', 'per_day'])->default('flat'); // flat = "for all time", per_day = multiplied by rental days
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extras');
    }
};
