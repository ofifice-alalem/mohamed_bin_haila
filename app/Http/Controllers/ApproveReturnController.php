<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ApproveReturnRequest;
use App\Services\ReturnService;
use Illuminate\Http\JsonResponse;

class ApproveReturnController extends Controller
{
    public function __construct(
        private readonly ReturnService $returnService
    ) {}

    public function __invoke(ApproveReturnRequest $request): JsonResponse
    {
        $this->returnService->approveReturnFromMarketer($request->toDto());

        return response()->json([
            'message' => 'Return approved successfully',
        ]);
    }
}