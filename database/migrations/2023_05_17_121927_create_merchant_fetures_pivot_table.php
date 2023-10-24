<?php

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
        Schema::create('merchant_features_pivot', function (Blueprint $table) {
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->foreignId('merchant_feature_id')->constrained('merchant_features');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('merchant_fetures_pivot');
    }
};
