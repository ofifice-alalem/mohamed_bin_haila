<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\StockMovement\StockMovement;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentStockMovementRepository implements StockMovementRepositoryInterface
{
    public function __construct(
        private readonly StockMovement $stockMovement
    ) {}

    public function findById(int $id): ?StockMovement
    {
        return $this->stockMovement->with(['marketer', 'product'])->find($id);
    }

    public function getByMarketer(int $marketerId): Collection
    {
        return $this->stockMovement->byMarketer($marketerId)->with(['product'])->get();
    }

    public function getByProduct(int $productId): Collection
    {
        return $this->stockMovement->byProduct($productId)->with(['marketer'])->get();
    }

    public function getByDate(string $date): Collection
    {
        return $this->stockMovement->byDate($date)->with(['marketer', 'product'])->get();
    }

    public function getWithRemaining(): Collection
    {
        return $this->stockMovement->withRemaining()->with(['marketer', 'product'])->get();
    }

    public function getByMarketerAndDate(int $marketerId, string $date): Collection
    {
        return $this->stockMovement->byMarketer($marketerId)->byDate($date)->with(['product'])->get();
    }

    public function create(array $data): StockMovement
    {
        return $this->stockMovement->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $updated = $this->stockMovement->where('id', $id)->update($data);
        return $updated > 0;
    }

    public function delete(int $id): bool
    {
        return $this->stockMovement->where('id', $id)->delete();
    }
}