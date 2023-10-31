<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantOfUser;
use App\Models\Merchant\MerchantUser;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        $this->registerPolicies();

                Gate::before(function ($user, $ability, $arguments) {
                    if ($user instanceof User) {
                        return true;
                    }
                    if($user instanceof MerchantUser) {

                        if (!is_null($ability)){
                            /** @var int $merchantId */
                            $merchantId = array_shift($arguments);
                        }

                        $merchantOfUser = MerchantOfUser::query()->where(
                            'merchant_user_id', '=', $user->id
                        )->where('merchant_id', '=', $merchantId)
                            ->with(['merchantOfUserAbilities'])->first();

                        if ($merchantOfUser){
                            $data = $merchantOfUser->merchantOfUserAbilities->where('name', '=', $ability);
                            if ($data->count() === 1) {
                                return true;
                            } else {
                                throw new AuthorizationException();
                            }
                        }

                        if (is_null($merchantOfUser)){
                            throw new AuthorizationException();
                        }


                    }
                });
        //
    }
}
