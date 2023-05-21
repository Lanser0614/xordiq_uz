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
        Schema::table('repayments', function (Blueprint $table) {
            $table->boolean("is_commission_taken")->default(false)->after("is_canceled")->comment("pulli atmen qivotganimizda bu puldan merchant comisiyasini op qolish keremi yoki yo'q");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repayments', function (Blueprint $table) {
            $table->dropColumn("is_commission_taken");
        });
    }
};
