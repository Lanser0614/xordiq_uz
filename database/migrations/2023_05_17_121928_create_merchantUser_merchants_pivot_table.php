<?php

use App\Enums\MerchantUser\MerchantUserRolesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('merchants_of_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_user_id')->constrained('merchant_users');
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->enum('role', [
                MerchantUserRolesEnum::OWNER()->getValue(),
                MerchantUserRolesEnum::OPERATOR()->getValue(),
            ]);
            $table->timestamps();
            $table->unique(['merchant_user_id', 'merchant_id', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('merchants_of_user');
    }
};
