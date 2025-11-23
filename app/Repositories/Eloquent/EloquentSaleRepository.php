<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\Sale\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentSaleRepository implements SaleRepositoryInterface
{
    public function __construct(
        private readonly Sale $sale
    ) {}

    public function findById(int $id): ?Sale
    {
        return $this->sale->with(['marketer', 'store', 'product'])->find($id);
    }

    public function getByMarketer(int $marketerId): Collection
    {
        return $this->sale->byMarketer($marketerId)->with(['store', 'product'])->get();
    }

    public function getByStore(int $storeId): Collection
    {
        return $this->sale->byStore($storeId)->with(['marketer', 'product'])->get();
    }

    public function getByDate(string $date): Collection
    {
        return $this->sale->byDate($date)->with(['marketer', 'store', 'product'])->get();
    }

    public function getByMarketerAndDate(int $marketerId, string $date): Collection
    {
        return $this->sale->byMarketer($marketerId)->byDate($date)->with(['store', 'product'])->get();
    }

    public function getInvoiceSent(): Collection
    {
        return $this->sale->invoiceSent()->with(['marketer', 'store', 'product'])->get();
    }

    public function getInvoiceNotSent(): Collection
    {
        return $this->sale->invoiceNotSent()->with(['marketer', 'store', 'product'])->get();
    }

    public function getTotalSalesToday(int $marketerId): float
    {
        return $this->sale->byMarketer($marketerId)
            ->byDate(now()->toDateString())
            ->sum('total');
    }

    public function create(array $data): Sale
    {
        return $this->sale->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->sale->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->sale->where('id', $id)->delete();
    }
}