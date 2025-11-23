<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\Sale\Sale;
use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryInterface
{
    /**
     * Find sale by ID
     */
    public function findById(int $id): ?Sale;

    /**
     * Get sales by marketer
     */
    public function getByMarketer(int $marketerId): Collection;

    /**
     * Get sales by store
     */
    public function getByStore(int $storeId): Collection;

    /**
     * Get sales by date
     */
    public function getByDate(string $date): Collection;

    /**
     * Get sales by marketer and date
     */
    public function getByMarketerAndDate(int $marketerId, string $date): Collection;

    /**
     * Get sales with invoice sent
     */
    public function getInvoiceSent(): Collection;

    /**
     * Get sales with invoice not sent
     */
    public function getInvoiceNotSent(): Collection;

    /**
     * Get total sales for marketer today
     */
    public function getTotalSalesToday(int $marketerId): float;

    /**
     * Create new sale
     */
    public function create(array $data): Sale;

    /**
     * Update sale
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete sale
     */
    public function delete(int $id): bool;
}