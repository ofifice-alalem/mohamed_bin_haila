<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\RequestReturnFromMarketerDto;
use App\DTOs\RequestReturnFromStoreDto;
use App\DTOs\ApproveReturnDto;
use App\Domains\ReturnFromMarketer\ReturnFromMarketer;
use App\Domains\ReturnFromStore\ReturnFromStore;
use App\Enums\ReturnStatusEnum;
use App\Repositories\Contracts\ReturnFromMarketerRepositoryInterface;
use App\Repositories\Contracts\ReturnFromStoreRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Service for managing return operations from marketers and stores
 */
class ReturnService
{
    public function __construct(
        private readonly ReturnFromMarketerRepositoryInterface $returnFromMarketerRepository,
        private readonly ReturnFromStoreRepositoryInterface $returnFromStoreRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly StoreRepositoryInterface $storeRepository,
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    /**
     * Request return from marketer
     */
    public function requestReturnFromMarketer(RequestReturnFromMarketerDto $dto): ReturnFromMarketer
    {
        return DB::transaction(function () use ($dto) {
            $marketer = $this->userRepository->findById($dto->marketerId);
            if (!$marketer) {
                throw new \InvalidArgumentException('Marketer not found');
            }

            $product = $this->productRepository->findById($dto->productId);
            if (!$product) {
                throw new \InvalidArgumentException('Product not found');
            }

            return $this->returnFromMarketerRepository->create([
                'marketer_id' => $dto->marketerId,
                'product_id' => $dto->productId,
                'quantity' => $dto->quantity,
                'status' => ReturnStatusEnum::PENDING,
                'requested_at' => now(),
                'notes' => $dto->notes,
            ]);
        });
    }

    /**
     * Request return from store
     */
    public function requestReturnFromStore(RequestReturnFromStoreDto $dto): ReturnFromStore
    {
        return DB::transaction(function () use ($dto) {
            $marketer = $this->userRepository->findById($dto->marketerId);
            if (!$marketer) {
                throw new \InvalidArgumentException('Marketer not found');
            }

            $store = $this->storeRepository->findById($dto->storeId);
            if (!$store) {
                throw new \InvalidArgumentException('Store not found');
            }

            $product = $this->productRepository->findById($dto->productId);
            if (!$product) {
                throw new \InvalidArgumentException('Product not found');
            }

            return $this->returnFromStoreRepository->create([
                'marketer_id' => $dto->marketerId,
                'store_id' => $dto->storeId,
                'product_id' => $dto->productId,
                'quantity' => $dto->quantity,
                'reason' => $dto->reason,
                'status' => ReturnStatusEnum::PENDING,
                'requested_at' => now(),
                'notes' => $dto->notes,
            ]);
        });
    }

    /**
     * Approve or reject return from marketer
     */
    public function approveReturnFromMarketer(ApproveReturnDto $dto): bool
    {
        return DB::transaction(function () use ($dto) {
            $approver = $this->userRepository->findById($dto->approvedBy);
            if (!$approver) {
                throw new \InvalidArgumentException('Approver not found');
            }

            return $this->returnFromMarketerRepository->update($dto->returnId, [
                'status' => $dto->status,
                'approved_at' => now(),
                'approved_by' => $dto->approvedBy,
                'notes' => $dto->notes,
            ]);
        });
    }

    /**
     * Approve or reject return from store
     */
    public function approveReturnFromStore(ApproveReturnDto $dto): bool
    {
        return DB::transaction(function () use ($dto) {
            $approver = $this->userRepository->findById($dto->approvedBy);
            if (!$approver) {
                throw new \InvalidArgumentException('Approver not found');
            }

            return $this->returnFromStoreRepository->update($dto->returnId, [
                'status' => $dto->status,
                'approved_at' => now(),
                'approved_by' => $dto->approvedBy,
                'notes' => $dto->notes,
            ]);
        });
    }
}