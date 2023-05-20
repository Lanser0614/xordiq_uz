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
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("amount");
            $table->foreignId("transaction_id")->constrained("transactions");
            $table->dateTime("date");
            $table->text("comment");
            $table->boolean("is_canceled")->default(false);
            $table->dateTime("canceled_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reapayments');
    }
};
