<?php

namespace Database\Seeders;

use App\Enums\MerchantUser\MerchantUserRolesEnum;
use App\Models\Common\Category;
use App\Models\Media\Image;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantFeature;
use App\Models\Merchant\MerchantUser;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Factory::create();
        $merchants = collect();
        for ($i = 0; $i <= 100; $i++) {
            $merchant = Merchant::query()->make(
                [
                    'title_uz' => $faker->sentence(10),
                    'title_ru' => $faker->sentence(10),
                    'title_en' => $faker->sentence(10),
                    'description_uz' => $faker->realText(100),
                    'description_ru' => $faker->realText(100),
                    'description_en' => $faker->realText(100),
                    'latitude' => $faker->latitude,
                    'longitude' => $faker->longitude,
                    'book_commission' => $faker->randomNumber(),
                ]
            );
            $merchants->add($merchant);
        }

        $merchants->map(function (Merchant $merchant) {
            $faker = Factory::create();
            $path = $faker->image(storage_path('app'), 640, 480, null, false);
            $image = new Image;
            $image->image_path = $path;

            /** @var MerchantUser $merchantUser */
            $merchantUser = MerchantUser::query()->inRandomOrder()->first();
            $categoryIds = Category::query()->inRandomOrder()->take(2)->pluck('id')->toArray();
            $merchantFeaturesIds = MerchantFeature::query()->inRandomOrder()->take(3)->pluck('id')->toArray();
            $merchant->save();
            $merchant->refresh();
            $merchant->merchantsFeatures()->sync($merchantFeaturesIds);
            $merchant->merchantsCategories()->sync($categoryIds);
            $merchant->merchantsUser()->sync(
                [$merchantUser->id,  ['role' => MerchantUserRolesEnum::OWNER()->getValue()]]
            );
            $merchant->images()->save($image);
        });
    }
}
