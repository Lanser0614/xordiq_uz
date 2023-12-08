<?php

declare(strict_types=1);

namespace App\UseCases\Mobile\User;

use App\DTOs\MobileDTOs\User\UserRegisterDto;
use App\Exceptions\DataBaseException;
use App\Models\User\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRegisterUseCase {
    /**
     * @throws DataBaseException
     * @throws Throwable
     */
    public function perform(UserRegisterDto $dto): void {
        if (App::isProduction()) {
            $otp = random_int(1000, 9999);
        } else {
            $otp = 1111;
        }

        $user = User::query()->wherePhone($dto->getPhone())->first();

        if ($user) {
            throw new DataBaseException('phoneNumber already have');
        }

        $user = new User;
        $user->phone = $dto->getPhone();
        $user->password = Hash::make($dto->getPassword());
        $user->name = $dto->getName();
        $user->email = $dto->getEmail();
        $user->otp = $otp;

        Cache::remember("otp_time_{$user->phone}", 180, function () use ($otp) {
            return $otp;
        });

        DB::transaction(function () use ($user) {
            $user->save();
        });
    }
}
