<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_uz' => fake()->randomElements(['Sanatoriya', 'Mehmonxona', 'Bolalar oromgohi', 'Dalahovli'], 1),
            'title_ru' => fake()->randomElements(['Санаторий', 'Гостиница', 'Детский санаторий', 'Дача'], 1),
            'title_en' => fake()->randomElements(['Sanatorium', 'Hotel', 'Childrens sanatorium', 'Dacha'], 1),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => null,
        ]);
    }
}
