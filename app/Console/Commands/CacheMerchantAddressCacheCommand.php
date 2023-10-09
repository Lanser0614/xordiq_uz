<?php

namespace App\Console\Commands;

use App\Models\Merchant;
use Illuminate\Console\Command;
use App\Enums\Cache\CacheKeyEnum;
use Illuminate\Support\Facades\Cache;

class CacheMerchantAddressCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:merchant-address-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $merchants = Merchant::query();

        $data = $merchants->select(['id', 'latitude', 'longitude'])->get()->toArray();

        Cache::remember(CacheKeyEnum::MERCHANT_POINTS->name, CacheKeyEnum::MERCHANT_POINTS->value, function () use ($data): array {
            return $data;
        });
    }
}
