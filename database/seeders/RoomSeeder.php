<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Merchant;
use App\Models\MerchantFeature;
use App\Models\MerchantUser;
use App\Models\Room;
use App\Models\RoomFeature;
use Database\Factories\MerchantFactory;
use Database\Factories\RoomFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

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

            $path =  $faker->image(storage_path('app/public'),640,480, null, false);
            $image = new Image;
            $image->image_path = $path;

            $room->roomFeatures()->attach($roomFeaturesIds);
            $room->images()->save($image);
        });
    }
}
