<?php

namespace App\Http\Controllers\Api\Admin\Room;

use App\DTOs\Room\StoreRoomDTO;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\Room\RoomStoreRequest;
use App\UseCases\Admin\Room\DeleteRoomUseCase;
use App\UseCases\Admin\Room\IndexRoomUseCase;
use App\UseCases\Admin\Room\ShowRoomUseCase;
use App\UseCases\Admin\Room\StoreRoomUseCase;
use App\UseCases\Admin\Room\UpdateRoomUseCase;
use Exception;
use Illuminate\Http\JsonResponse;

class RoomController extends BaseApiController
{
    public function index(int $merchant_id, IndexRoomUseCase $useCase): JsonResponse
    {
        $merchantsRoom = $useCase->execute($merchant_id, auth()->user());

        return new JsonResponse($merchantsRoom);
    }

    public function show(int $merchant_id, int $room_id, ShowRoomUseCase $useCase): JsonResponse
    {
        try {
            $room = $useCase->execute($merchant_id, $room_id, auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($room);
    }

    public function delete(int $merchant_id, int $room_id, DeleteRoomUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($merchant_id, $room_id, auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseOnDelete());
    }

    public function store(int $merchant_id, RoomStoreRequest $request, StoreRoomUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($merchant_id, StoreRoomDTO::frommArray($request->validated()), auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }

    public function update(int $merchant_id, int $room_id, RoomStoreRequest $request, UpdateRoomUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($merchant_id, $room_id, StoreRoomDTO::frommArray($request->validated()), auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }
}
