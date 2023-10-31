<?php

namespace App\Http\Middleware\User;

use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Models\Merchant\MerchantUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class CheckMerchantUserMiddleware {
    public function handle(Request $request, Closure $next): mixed {
        if (auth()->user() instanceof MerchantUser === false) {
            throw new UnauthorizedException(ExceptionEnum::ENTITY_NOT_FOUND->name);
        }

        return $next($request);
    }
}
