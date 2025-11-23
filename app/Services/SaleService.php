<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\CreateSaleDto;
use App\Domains\Sale\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Service for managing sales operations and transactions
 */
class SaleService
{
    public function __construct(
        private readonly SaleRepositoryInterface $saleRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly StoreRepositoryInterface $storeRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly StockMovementService $stockMovementService
    ) {}

    /**
     * Record sale and update stock movement
     */
    public function recordSale(CreateSaleDto $dto): Sale
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

            $total = $dto->quantity * $dto->priceAtSale;

            $sale = $this->saleRepository->create([
                'marketer_id' => $dto->marketerId,
                'store_id' => $dto->storeId,
                'product_id' => $dto->productId,
                'quantity' => $dto->quantity,
                'price_at_sale' => $dto->priceAtSale,
                'total' => $total,
                'sale_date' => $dto->saleDate,
                'invoice_sent' => false,
            ]);

            $this->stockMovementService->updateRemainingQuantity(
                $dto->marketerId,
                $dto->productId,
                $dto->saleDate,
                $dto->quantity
            );

            return $sale;
        });
    }

    /**
     * Mark sales as invoice sent
     */
    public function markInvoiceSent(array $saleIds): bool
    {
        return DB::transaction(function () use ($saleIds) {
            foreach ($saleIds as $saleId) {
                $this->saleRepository->update($saleId, ['invoice_sent' => true]);
            }
            return true;
        });
    }
}