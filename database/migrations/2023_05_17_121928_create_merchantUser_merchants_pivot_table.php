<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_user_merchants_pivot', function (Blueprint $table) {
            $table->foreignId('merchant_user_id')->constrained("merchant_users");
            $table->foreignId('merchant_id')->constrained("merchants");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchantUser_merchants_pivot');
    }
};
