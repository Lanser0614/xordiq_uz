<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Merchant;
use App\Models\MerchantFeature;
use App\Models\MerchantUser;
use Database\Factories\MerchantFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $merchants = MerchantFactory::new()->count(10)->create();

        $merchants->map(function (Merchant $merchant) {
            $faker = Factory::create();
            $path = $faker->image(storage_path('app/public'), 640, 480, null, false);
            $image = new Image;
            $image->image_path = $path;

            $merchantUser = MerchantUser::query()->inRandomOrder()->first();
            $categoryIds = Category::query()->inRandomOrder()->take(2)->pluck('id')->toArray();
            $merchantFeaturesIds = MerchantFeature::query()->inRandomOrder()->take(3)->pluck('id')->toArray();
            $merchant->save();
            $merchant->merchantsFeatures()->sync($merchantFeaturesIds);
            $merchant->merchantsCategories()->sync($categoryIds);
            $merchant->merchantsUser()->sync($merchantUser);
            $merchant->images()->save($image);
        });
    }
}
