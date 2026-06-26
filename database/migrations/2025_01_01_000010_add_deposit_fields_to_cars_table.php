<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('deposit_amount', 10, 2)->default(0)->after('price_per_day');
            $table->unsignedInteger('included_km_per_day')->default(0)->after('deposit_amount'); // 0 = unlimited
            $table->unsignedTinyInteger('bags')->default(2)->after('seats');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['deposit_amount', 'included_km_per_day', 'bags']);
        });
    }
};
