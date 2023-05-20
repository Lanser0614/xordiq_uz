<?php

namespace App\Providers;

use App\Repository\MerchantRepository\MerchantRepository;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Repository\MerchantUserRepository\UserRepository;
use App\Repository\MerchantUserRepository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MerchantRepositoryInterface::class, MerchantRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
