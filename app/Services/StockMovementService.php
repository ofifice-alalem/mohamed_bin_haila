<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\IssueStockToMarketerDto;
use App\Domains\StockMovement\StockMovement;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Service for managing stock movements and inventory operations
 */
class StockMovementService
{
    public function __construct(
        private readonly StockMovementRepositoryInterface $stockMovementRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    /**
     * Issue stock to marketer for daily distribution
     * إذا كانت الحركة موجودة لنفس المسوق والمنتج والتاريخ، يتم تحديثها بدلاً من إنشاء واحدة جديدة
     */
    public function issueStockToMarketer(IssueStockToMarketerDto $dto): StockMovement
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

            // التحقق من وجود حركة لنفس المسوق والمنتج والتاريخ
            $existingMovements = $this->stockMovementRepository->getByMarketerAndDate(
                $dto->marketerId,
                $dto->movementDate
            );

            $existingMovement = $existingMovements->firstWhere('product_id', $dto->productId);

            if ($existingMovement) {
                // تحديث الحركة الموجودة: إضافة الكمية الجديدة
                $newQuantityTaken = $existingMovement->quantity_taken + $dto->quantityTaken;
                $newQuantityRemaining = $existingMovement->quantity_remaining + $dto->quantityTaken;

                $this->stockMovementRepository->update($existingMovement->id, [
                    'quantity_taken' => $newQuantityTaken,
                    'quantity_remaining' => $newQuantityRemaining,
                ]);

                return $this->stockMovementRepository->findById($existingMovement->id);
            }

            // إنشاء حركة جديدة إذا لم تكن موجودة
            return $this->stockMovementRepository->create([
                'marketer_id' => $dto->marketerId,
                'product_id' => $dto->productId,
                'quantity_taken' => $dto->quantityTaken,
                'quantity_sold' => 0,
                'quantity_remaining' => $dto->quantityTaken,
                'movement_date' => $dto->movementDate,
            ]);
        });
    }

    /**
     * Update remaining quantity after sale
     */
    public function updateRemainingQuantity(int $marketerId, int $productId, string $date, int $soldQuantity): bool
    {
        $movements = $this->stockMovementRepository->getByMarketerAndDate($marketerId, $date);
        
        foreach ($movements as $movement) {
            if ($movement->product_id === $productId && $movement->quantity_remaining >= $soldQuantity) {
                return $this->stockMovementRepository->update($movement->id, [
                    'quantity_sold' => $movement->quantity_sold + $soldQuantity,
                    'quantity_remaining' => $movement->quantity_remaining - $soldQuantity,
                ]);
            }
        }

        throw new \Exception('Insufficient stock available');
    }
}