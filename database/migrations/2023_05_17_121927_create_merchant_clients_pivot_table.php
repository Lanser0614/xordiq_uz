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
        Schema::create('merchant_clients_pivot', function (Blueprint $table) {
            $table->integer('merchant_id');
            $table->integer('user_id')->index('merchant_clients_pivot_fk1');

            $table->primary(['merchant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_clients_pivot');
    }
};
