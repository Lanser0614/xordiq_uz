<?php

use App\Enums\Order\OrderStatusEnum;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('merchant_user_id')->constrained('merchant_users');
            $table->unsignedBigInteger('room_id');
            $table->integer('human_count')->default(1);
            $table->boolean('is_cooperative')->default(false);
            $table->integer('amount_with_discount')->nullable()->comment("bu columnga yoziladi qachonki odam soni ko'p bo'p berilgan narxdan skidka berishmoqchi bo'sa");

            $table->enum('status', [
                OrderStatusEnum::NEW->name,
                OrderStatusEnum::IN_PROCESSING->name,
                OrderStatusEnum::CONFIRMED->name,
                OrderStatusEnum::CANCELED->name,
            ])->default(OrderStatusEnum::NEW->name);
            $table->foreignId('processed_by_id')->constrained('merchant_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
