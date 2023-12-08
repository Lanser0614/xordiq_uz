<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ability_of_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_of_user_id')->constrained('merchants_of_user');
            $table->foreignId('ability_id')->constrained('abilities');
            $table->unique([
                'merchant_of_user_id',
                'ability_id',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ability_of_users');
    }
};
