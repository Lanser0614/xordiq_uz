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
        Schema::create('merchant_fetures_pivot', function (Blueprint $table) {
            $table->integer('merchant_id')->index('merchant_fetures_pivot_fk0');
            $table->integer('feture_id')->index('merchant_fetures_pivot_fk1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_fetures_pivot');
    }
};
