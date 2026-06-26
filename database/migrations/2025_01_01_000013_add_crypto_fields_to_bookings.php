<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // payment_method already exists (added in migration 000011), just add crypto_txid
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('crypto_txid')->nullable()->after('payment_method')
                  ->comment('Transaction ID / hash provided by customer after crypto payment');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('crypto_txid');
        });
    }
};
