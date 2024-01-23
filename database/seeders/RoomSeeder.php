<?php

namespace Database\Seeders;

use App\Models\Media\Image;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\Room;
use App\Models\Merchant\RoomFeature;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Factory::create();
        $rooms = collect();
        for ($i = 0; $i <= 100; $i++) {
            $merchant = Room::query()->make(
                [
                    'title_uz' => $faker->sentence(10),
                    'title_ru' => $faker->sentence(10),
                    'title_en' => $faker->sentence(10),
                    'price' => $faker->numberBetween(0, 1000000),
                    'merchant_id' => Merchant::query()->inRandomOrder()->first()->id,
                ]
            );
            $rooms->add($merchant);
        }

        $rooms->map(function (Room $room) {
            $faker = Factory::create();

            $roomFeaturesIds = RoomFeature::query()->inRandomOrder()->take(3)->pluck('id')->toArray();
            $room->save();

            $path = $faker->image(storage_path('app'), 640, 480, null, false);
            $image = new Image;
            $image->image_path = $path;

            $room->roomFeatures()->attach($roomFeaturesIds);
            $room->images()->save($image);
        });
    }
}
