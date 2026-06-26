<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('car_id')->nullable()->constrained('cars')->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->date('pickup_date')->nullable();
            $table->date('return_date')->nullable();
            $table->boolean('additional_driver')->default(false);
            $table->boolean('child_seat')->default(false);
            $table->boolean('gps')->default(false);
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'confirmed', 'completed', 'cancelled'])->default('new');
            $table->string('locale', 5)->default('hy');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
