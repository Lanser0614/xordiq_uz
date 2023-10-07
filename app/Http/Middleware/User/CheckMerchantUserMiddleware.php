<?php

namespace App\Http\Middleware\User;

use Closure;
use App\Models\MerchantUser;
use Illuminate\Http\Request;
use App\Enums\ExceptionEnum\ExceptionEnum;
use Illuminate\Validation\UnauthorizedException;

class CheckMerchantUserMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->user() instanceof MerchantUser === false) {
            throw new UnauthorizedException(ExceptionEnum::ENTITY_NOT_FOUND->name);
        }

        return $next($request);
    }
}
