<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('extra_id')->constrained('extras')->cascadeOnDelete();
            $table->decimal('price_at_booking', 10, 2); // snapshot of price when booked, so later admin price changes don't alter past bookings
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_extras');
    }
};
