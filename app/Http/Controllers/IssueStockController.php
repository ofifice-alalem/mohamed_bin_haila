<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IssueStockRequest;
use App\Http\Resources\StockMovementResource;
use App\Services\StockMovementService;
use Illuminate\Http\JsonResponse;

class IssueStockController extends Controller
{
    public function __construct(
        private readonly StockMovementService $stockMovementService
    ) {}

    public function __invoke(IssueStockRequest $request): JsonResponse
    {
        $stockMovement = $this->stockMovementService->issueStockToMarketer($request->toDto());

        return response()->json([
            'message' => 'Stock issued successfully',
            'data' => new StockMovementResource($stockMovement),
        ], 201);
    }
}