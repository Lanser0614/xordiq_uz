<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('merchants', function (Blueprint $table) {
            $table->foreignId('village_id')->nullable()->after('description_en')->constrained('villages');
            $table->foreignId('district_id')->nullable()->after('village_id')->constrained('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn('village_id');
            $table->dropColumn('district_id');
        });
    }
};
