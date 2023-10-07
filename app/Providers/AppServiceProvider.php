<?php

namespace App\Providers;

use App\Models\Room;
use App\Models\MerchantUser;
use Illuminate\Support\ServiceProvider;
use App\Repository\RoomRepository\RoomRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Repository\MerchantRepository\MerchantRepository;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use App\Repository\RoomFeatureRepository\RoomFeatureRepository;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepository;
use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;
use App\Repository\MerchantUserRepository\MerchantMerchantUserRepository;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MerchantUserRepositoryInterface::class, MerchantMerchantUserRepository::class);
        $this->app->bind(MerchantRepositoryInterface::class, MerchantRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(MerchantFeatureRepositoryInterface::class, MerchantFeatureRepository::class);
        $this->app->bind(RoomFeatureRepositoryInterface::class, RoomFeatureRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'room' => Room::class,
            'merchant_user' => MerchantUser::class,
            'merchant' => MerchantRepositoryInterface::class,
        ]);
    }
}
