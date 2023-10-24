<?php

namespace App\Http\Controllers\Api\Admin\MerchantUser;

use App\DTOs\MerchantUser\MerchantUserRegisterDto;
use App\DTOs\MerchantUser\UserLoginDto;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\MerchantUser\LoginRequest;
use App\Http\Requests\Admin\MerchantUser\LoginWithOtpRequest;
use App\Http\Requests\Admin\MerchantUser\UserRegisterRequest;
use App\UseCases\Admin\MerchantUser\MerchantUserRegisterUseCase;
use App\UseCases\Admin\MerchantUser\UserLoginUseCase;
use App\UseCases\Admin\MerchantUser\UserLoginWithOtpUseCase;
use App\UseCases\Admin\MerchantUser\UserSendOtpUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantUserController extends BaseApiController {
    /**
     * @throws ParseException
     * @throws Exception
     */
    public function login(LoginRequest $request, UserLoginUseCase $useCase): JsonResponse {
        $token = $useCase->execute(UserLoginDto::frommArray($request->validated()));

        return new JsonResponse($this->responseWithToken($token));
    }

    /**
     * @throws Exception
     */
    public function sendOtp(Request $request, UserSendOtpUseCase $useCase): JsonResponse {
        $useCase->execute($request->input('phone'));

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @throws Exception
     */
    public function loginWithOtp(LoginWithOtpRequest $request, UserLoginWithOtpUseCase $useCase): JsonResponse {
        $token = $useCase->execute($request->input('phone'), $request->input('otp'));

        return new JsonResponse($this->responseWithToken($token));
    }

    public function register(UserRegisterRequest $request, MerchantUserRegisterUseCase $useCase): JsonResponse {
        try {
            $useCase->execute(MerchantUserRegisterDto::frommArray($request->validated()));
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }
}
