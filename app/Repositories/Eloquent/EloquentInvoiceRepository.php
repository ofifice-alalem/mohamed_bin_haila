<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\Invoice\Invoice;
use App\Enums\InvoiceStatusEnum;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentInvoiceRepository implements InvoiceRepositoryInterface
{
    public function __construct(
        private readonly Invoice $invoice
    ) {}

    public function findById(int $id): ?Invoice
    {
        return $this->invoice->with(['store'])->find($id);
    }

    public function getByStore(int $storeId): Collection
    {
        return $this->invoice->byStore($storeId)->get();
    }

    public function getByStatus(InvoiceStatusEnum $status): Collection
    {
        return $this->invoice->byStatus($status)->with(['store'])->get();
    }

    public function getPending(): Collection
    {
        return $this->invoice->pending()->with(['store'])->get();
    }

    public function getSent(): Collection
    {
        return $this->invoice->sent()->with(['store'])->get();
    }

    public function getPaid(): Collection
    {
        return $this->invoice->paid()->with(['store'])->get();
    }

    public function getByPeriod(string $startDate, string $endDate): Collection
    {
        return $this->invoice->byPeriod($startDate, $endDate)->with(['store'])->get();
    }

    public function create(array $data): Invoice
    {
        return $this->invoice->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->invoice->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->invoice->where('id', $id)->delete();
    }
}