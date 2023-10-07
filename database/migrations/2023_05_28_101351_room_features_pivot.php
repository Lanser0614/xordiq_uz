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
        Schema::create('room_features_pivot', function (Blueprint $table) {
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('room_feature_id')->constrained('room_features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_features_pivot');
    }
};
