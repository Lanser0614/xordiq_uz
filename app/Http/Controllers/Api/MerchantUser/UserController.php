<?php

namespace App\Http\Controllers\Api\MerchantUser;

use App\DTOs\MerchantUser\MerchantUserRegisterDto;
use App\DTOs\MerchantUser\UserLoginDto;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\MerchantUser\LoginRequest;
use App\Http\Requests\MerchantUser\LoginWithOtpRequest;
use App\Http\Requests\MerchantUser\UserRegisterRequest;
use App\UseCases\MerchantUser\MerchantUserRegisterUseCase;
use App\UseCases\MerchantUser\UserLoginUseCase;
use App\UseCases\MerchantUser\UserLoginWithOtpUseCase;
use App\UseCases\MerchantUser\UserSendOtpUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    /**
     * @throws ParseException
     * @throws Exception
     */
    public function login(LoginRequest $request, UserLoginUseCase $useCase): JsonResponse
    {
        $token = $useCase->execute(UserLoginDto::frommArray($request->validated()));

        return new JsonResponse($this->responseWithToken($token));
    }

    /**
     * @throws Exception
     */
    public function sendOtp(Request $request, UserSendOtpUseCase $useCase): JsonResponse
    {
        $useCase->execute($request->input('phone'));

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @throws Exception
     */
    public function loginWithOtp(LoginWithOtpRequest $request, UserLoginWithOtpUseCase $useCase): JsonResponse
    {
        $token = $useCase->execute($request->input('phone'), $request->input('otp'));

        return new JsonResponse($this->responseWithToken($token));
    }

    /**
     * @param UserRegisterRequest $request
     * @param MerchantUserRegisterUseCase $useCase
     * @return JsonResponse
     *
     */
    public function register(UserRegisterRequest $request, MerchantUserRegisterUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute(MerchantUserRegisterDto::frommArray($request->validated()));
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }
}
