<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RequestMarketerReturnRequest;
use App\Http\Resources\ReturnResource;
use App\Services\ReturnService;
use Illuminate\Http\JsonResponse;

class RequestMarketerReturnController extends Controller
{
    public function __construct(
        private readonly ReturnService $returnService
    ) {}

    public function __invoke(RequestMarketerReturnRequest $request): JsonResponse
    {
        $return = $this->returnService->requestReturnFromMarketer($request->toDto());

        return response()->json([
            'message' => 'Return request submitted successfully',
            'data' => new ReturnResource($return),
        ], 201);
    }
}