<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\Store\Store;
use Illuminate\Database\Eloquent\Collection;

interface StoreRepositoryInterface
{
    /**
     * Find store by ID
     */
    public function findById(int $id): ?Store;

    /**
     * Get all stores
     */
    public function getAll(): Collection;

    /**
     * Search stores by name
     */
    public function searchByName(string $name): Collection;

    /**
     * Find store by phone
     */
    public function findByPhone(string $phone): ?Store;

    /**
     * Get stores with specific credit days
     */
    public function getByCreditDays(int $days): Collection;

    /**
     * Create new store
     */
    public function create(array $data): Store;

    /**
     * Update store
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete store (soft delete)
     */
    public function delete(int $id): bool;
}