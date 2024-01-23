<?php

namespace Database\Seeders;

use App\Models\Merchant\MerchantUser;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MerchantUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Factory::create();
        for ($i = 0; $i <= 1000; $i++) {
            MerchantUser::query()->make(
                [
                    'name' => fake()->name(),
                    'surname' => fake()->lastName(),
                    'role' => 'operator',
                    'email' => fake()->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10),
                    'phone' => fake()->unique()->numberBetween(),
                    'otp' => fake()->randomNumber(),
                ]
            )->save();
        }
    }
}
