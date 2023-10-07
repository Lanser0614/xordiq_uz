<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MerchantUser;
use App\Models\User;
use App\Models\Category;
use Database\Factories\MerchantUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SqlFileSeeder::class);
        User::factory(10)->create();
        Category::factory(5)->create();
        MerchantUserFactory::factoryForModel(MerchantUser::class)->count(10)->create();
        $this->call(MerchantSeeder::class);
        $this->call(RoomSeeder::class);
    }
}
