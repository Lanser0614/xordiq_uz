<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('merchant_clients_pivot', function (Blueprint $table) {
            $table->integer('merchant_id');
            $table->integer('user_id')->index('merchant_clients_pivot_fk1');

            $table->primary(['merchant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_clients_pivot');
    }
};
