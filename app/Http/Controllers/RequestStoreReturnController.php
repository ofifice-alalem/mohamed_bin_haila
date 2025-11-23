<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreReturnRequest;
use App\Http\Resources\ReturnResource;
use App\Services\ReturnService;
use Illuminate\Http\JsonResponse;

class RequestStoreReturnController extends Controller
{
    public function __construct(
        private readonly ReturnService $returnService
    ) {}

    public function __invoke(RequestStoreReturnRequest $request): JsonResponse
    {
        $return = $this->returnService->requestReturnFromStore($request->toDto());

        return response()->json([
            'message' => 'Store return request submitted successfully',
            'data' => new ReturnResource($return),
        ], 201);
    }
}