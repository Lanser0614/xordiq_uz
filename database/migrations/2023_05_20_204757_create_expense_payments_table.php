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
        Schema::create('expense_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('amount');
            $table->dateTime('date');
            $table->text('comment');
            $table->enum('expense_payment_type', ['OFFLINE', 'ONLINE']);
            $table->enum('expense_payment_method_key', ['payme', 'click', 'cash']);
            $table->boolean('is_canceled')->default(false);
            $table->dateTime('canceled_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_payments');
    }
};
