<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RecordSaleRequest;
use App\Http\Resources\SaleResource;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class RecordSaleController extends Controller
{
    public function __construct(
        private readonly SaleService $saleService
    ) {}

    public function __invoke(RecordSaleRequest $request): JsonResponse
    {
        $sale = $this->saleService->recordSale($request->toDto());

        return response()->json([
            'message' => 'Sale recorded successfully',
            'data' => new SaleResource($sale),
        ], 201);
    }
}