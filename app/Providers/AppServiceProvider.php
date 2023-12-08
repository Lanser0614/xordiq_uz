<?php

namespace App\Providers;

use App\Models\Merchant\MerchantUser;
use App\Models\Merchant\Room;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepository;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;
use App\Repository\MerchantRepository\MerchantRepository;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\MerchantMerchantUserRepository;
use App\Repository\MerchantUserRepository\MerchantUserRepositoryInterface;
use App\Repository\RoomFeatureRepository\RoomFeatureRepository;
use App\Repository\RoomFeatureRepository\RoomFeatureRepositoryInterface;
use App\Repository\RoomRepository\RoomRepository;
use App\Repository\RoomRepository\RoomRepositoryInterface;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->bind(MerchantUserRepositoryInterface::class, MerchantMerchantUserRepository::class);
        $this->app->bind(MerchantRepositoryInterface::class, MerchantRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(MerchantFeatureRepositoryInterface::class, MerchantFeatureRepository::class);
        $this->app->bind(RoomFeatureRepositoryInterface::class, RoomFeatureRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Event::listen(QueryExecuted::class, function (QueryExecuted $evnt) {
            Log::debug('query', [$evnt->sql]);
        });

        Relation::morphMap([
            'room' => Room::class,
            'merchant_user' => MerchantUser::class,
            'merchant' => MerchantRepositoryInterface::class,
        ]);
    }
}
