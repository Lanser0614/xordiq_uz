<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_uz' => $this->faker->sentence(10),
            'title_ru' => $this->faker->sentence(10),
            'title_en' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(0, 1000000),
            'merchant_id' => Merchant::query()->inRandomOrder()->first()->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
