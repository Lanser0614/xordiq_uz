<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Mobile;

use App\DTOs\MobileDTOs\User\UserRegisterDto;
use App\Exceptions\BusinessException;
use App\Filter\EloquentFilter\Merchant\MerchantByIds;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Mobile\User\LoginRequest;
use App\Http\Requests\Mobile\User\LoginWithOtpRequest;
use App\Http\Requests\Mobile\User\UserRegisterRequest;
use App\Models\Merchant\Merchant;
use App\Models\User\Favorite;
use App\Models\User\User;
use App\Tasks\Checker\CheckEntityTask;
use App\UseCases\Mobile\User\UserLoginWithOtpUseCase;
use App\UseCases\Mobile\User\UserRegisterUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class MobileUserController extends BaseApiController {
    public function __construct(
        private readonly UserRegisterUseCase $registerUseCase,
        private readonly UserLoginWithOtpUseCase $loginWithOtpUseCase,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    /**
     * @throws Throwable
     */
    public function register(UserRegisterRequest $request): JsonResponse {
        try {
            $this->registerUseCase->perform(UserRegisterDto::frommArray($request->validated()));
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @throws BusinessException
     */
    public function loginWithOtp(LoginWithOtpRequest $request): JsonResponse {
        $token = $this->loginWithOtpUseCase->perform($request->input('phone'), $request->input('otp'));

        return new JsonResponse($this->responseWithToken($token));
    }

    /**
     * @throws BusinessException
     */
    public function login(LoginRequest $request): JsonResponse {
        $user = User::query()->wherePhone($request->input('phone'))->first();

        $this->checkEntityTask->run($user);

        if (Hash::check($request->input('password'), $user->password)) {
            $token = $user->createToken('xordiq.uz')->plainTextToken;
        } else {
            throw new BusinessException('Wrong password');
        }

        return new JsonResponse($this->responseWithToken($token));
    }

    /**
     * @throws BusinessException
     */
    public function addFavorites(Request $request): JsonResponse {
        $request->validate([
            'favorite_ids' => ['required', 'array'],
        ]);
        $favoriteIds = $request->input('favorite_ids');

        $merchantCount = Merchant::query()->whereIn('id', $favoriteIds)->count();

        if (count($favoriteIds) != $merchantCount) {
            throw new BusinessException('Wrong merchants');
        }

        /** @var User $user */
        $user = auth()->user();

        Favorite::query()->whereUserId($user->id)->delete();
        $insertArray = [];
        foreach ($favoriteIds as $id) {
            $insertArray[] = [
                'user_id' => $user->id,
                'merchant_id' => $id,
            ];
        }

        Favorite::query()->insert($insertArray);

        return new JsonResponse($this->responseSuccess());
    }

    public function merchantIndex(
        Request $request,
    ): JsonResponse {
        $merchants = Merchant::query()
            ->filter(
                $request,
                [
                    MerchantByIds::class,
                ]
            )
            ->latest()->paginate($request->input('perPage'));

        return new JsonResponse($this->responseWithPagination($merchants));
    }
}
