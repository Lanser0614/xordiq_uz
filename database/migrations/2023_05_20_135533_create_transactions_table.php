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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type', ['OFFLINE', 'ONLINE']);
            $table->enum('payment_method_key', ['payme', 'click', 'cash']);
            $table->unsignedBigInteger('amount');
            $table->dateTime('date');
            $table->text('comment');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->boolean('is_canceled')->default(false);
            $table->dateTime('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
