<?php

namespace App\Http\Controllers\Api\Room;

use App\DTOs\Room\StoreRoomDTO;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Room\RoomStoreRequest;
use App\UseCases\Room\DeleteRoomUseCase;
use App\UseCases\Room\IndexRoomUseCase;
use App\UseCases\Room\ShowRoomUseCase;
use App\UseCases\Room\StoreRoomUseCase;
use App\UseCases\Room\UpdateRoomUseCase;
use Exception;
use Illuminate\Http\JsonResponse;

class RoomController extends BaseApiController
{
    /**
     * @param int $merchant_id
     * @param IndexRoomUseCase $useCase
     * @return JsonResponse
     */
    public function index(int $merchant_id, IndexRoomUseCase $useCase): JsonResponse
    {
        $merchantsRoom = $useCase->execute($merchant_id, auth()->user());
        return new JsonResponse($merchantsRoom);
    }

    /**
     * @param int $merchant_id
     * @param int $room_id
     * @param ShowRoomUseCase $useCase
     * @return JsonResponse
     */
    public function show(int $merchant_id, int $room_id, ShowRoomUseCase $useCase): JsonResponse
    {
        $room = $useCase->execute($merchant_id, $room_id, auth()->user());
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

    /**
     * @param int $merchant_id
     * @param RoomStoreRequest $request
     * @param StoreRoomUseCase $useCase
     * @return JsonResponse
     */
    public function store(int $merchant_id, RoomStoreRequest $request, StoreRoomUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($merchant_id, StoreRoomDTO::frommArray($request->validated()), auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param int $merchant_id
     * @param int $room_id
     * @param RoomStoreRequest $request
     * @param UpdateRoomUseCase $useCase
     * @return JsonResponse
     */
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
