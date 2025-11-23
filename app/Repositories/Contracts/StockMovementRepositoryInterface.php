<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\StockMovement\StockMovement;
use Illuminate\Database\Eloquent\Collection;

interface StockMovementRepositoryInterface
{
    /**
     * Find stock movement by ID
     */
    public function findById(int $id): ?StockMovement;

    /**
     * Get stock movements by marketer
     */
    public function getByMarketer(int $marketerId): Collection;

    /**
     * Get stock movements by product
     */
    public function getByProduct(int $productId): Collection;

    /**
     * Get stock movements by date
     */
    public function getByDate(string $date): Collection;

    /**
     * Get stock movements with remaining quantity
     */
    public function getWithRemaining(): Collection;

    /**
     * Get stock movements by marketer and date
     */
    public function getByMarketerAndDate(int $marketerId, string $date): Collection;

    /**
     * Create new stock movement
     */
    public function create(array $data): StockMovement;

    /**
     * Update stock movement
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete stock movement
     */
    public function delete(int $id): bool;
}