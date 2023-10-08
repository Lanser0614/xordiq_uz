<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class MerchantFactory extends Factory
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
            'description_uz' => $this->faker->realText(100),
            'description_ru' => $this->faker->realText(100),
            'description_en' => $this->faker->realText(100),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'book_commisison' => $this->faker->randomNumber(),
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
