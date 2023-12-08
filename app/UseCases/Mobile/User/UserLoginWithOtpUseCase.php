<?php

declare(strict_types=1);

namespace App\UseCases\Mobile\User;

use App\Enums\ExceptionEnum\ExceptionEnum;
use App\Exceptions\BusinessException;
use App\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class UserLoginWithOtpUseCase {
    /**
     * @throws BusinessException
     */
    public function perform(int $phone, int $otp): string {
        $user = User::query()->wherePhone($phone)->first();

        if ($user === null) {
            throw new ModelNotFoundException(ExceptionEnum::ENTITY_NOT_FOUND->name, 404);
        }

        if (Cache::get('otp_time_'.$phone) === $otp) {
            $token = $user->createToken('xordiq.uz')->plainTextToken;
        } else {
            throw new BusinessException('Wrong otp');
        }

        return $token;
    }
}
