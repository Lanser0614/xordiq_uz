<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = public_path('sql/regions.sql');
        $featuresPath = public_path('sql/features.sql');
        $categoriesPath = public_path('sql/categories.sql');

        $sql = file_get_contents($path);
        $featuresSql = file_get_contents($featuresPath);
        $categoriesSql = file_get_contents($categoriesPath);

        DB::unprepared($sql);
        DB::unprepared($featuresSql);
        DB::unprepared($categoriesSql);
    }
}
