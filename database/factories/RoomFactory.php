<?php

namespace Database\Factories;

use App\Models\Merchant\Merchant;
use App\Models\Merchant\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title_uz' => $this->faker->sentence(10),
            'title_ru' => $this->faker->sentence(10),
            'title_en' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(0, 1000000),
            'merchant_id' => Merchant::query()->inRandomOrder()->first()->id,
        ];
    }
}
