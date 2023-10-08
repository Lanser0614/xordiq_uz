<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Room;
use App\Models\Image;
use App\Models\RoomFeature;
use Illuminate\Database\Seeder;
use Database\Factories\RoomFactory;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = RoomFactory::new()->count(50)->create();

        $rooms->map(function (Room $room) {
            $faker = Factory::create();

            $roomFeaturesIds = RoomFeature::query()->inRandomOrder()->take(3)->pluck('id')->toArray();
            $room->save();

            $path = $faker->image(storage_path('app/public'), 640, 480, null, false);
            $image = new Image;
            $image->image_path = $path;

            $room->roomFeatures()->attach($roomFeaturesIds);
            $room->images()->save($image);
        });
    }
}
