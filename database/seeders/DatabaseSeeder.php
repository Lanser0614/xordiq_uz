<?php

namespace Database\Seeders;

use App\Models\Merchant\MerchantUser;
use App\Models\User\User;
use Database\Factories\MerchantUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(SqlFileSeeder::class);
//        User::factory(10)->create();
//                MerchantUserFactory::factoryForModel(MerchantUser::class)->count(10)->create();
//                $this->call(MerchantSeeder::class);
//                $this->call(RoomSeeder::class);
    }
}
