<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\Invoice\Invoice;
use App\Enums\InvoiceStatusEnum;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceRepositoryInterface
{
    /**
     * Find invoice by ID
     */
    public function findById(int $id): ?Invoice;

    /**
     * Get invoices by store
     */
    public function getByStore(int $storeId): Collection;

    /**
     * Get invoices by status
     */
    public function getByStatus(InvoiceStatusEnum $status): Collection;

    /**
     * Get pending invoices
     */
    public function getPending(): Collection;

    /**
     * Get sent invoices
     */
    public function getSent(): Collection;

    /**
     * Get paid invoices
     */
    public function getPaid(): Collection;

    /**
     * Get invoices by period
     */
    public function getByPeriod(string $startDate, string $endDate): Collection;

    /**
     * Create new invoice
     */
    public function create(array $data): Invoice;

    /**
     * Update invoice
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete invoice
     */
    public function delete(int $id): bool;
}