<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\GenerateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;

class GenerateInvoiceController extends Controller
{
    public function __construct(
        private readonly InvoiceService $invoiceService
    ) {}

    public function __invoke(GenerateInvoiceRequest $request): JsonResponse
    {
        $invoice = $this->invoiceService->generateInvoice($request->toDto());

        return response()->json([
            'message' => 'Invoice generated successfully',
            'data' => new InvoiceResource($invoice),
        ], 201);
    }
}