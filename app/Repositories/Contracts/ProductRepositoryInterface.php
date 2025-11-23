<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\Product\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Find product by ID
     */
    public function findById(int $id): ?Product;

    /**
     * Get all products
     */
    public function getAll(): Collection;

    /**
     * Search products by name
     */
    public function searchByName(string $name): Collection;

    /**
     * Get products by unit
     */
    public function getByUnit(string $unit): Collection;

    /**
     * Create new product
     */
    public function create(array $data): Product;

    /**
     * Update product
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete product
     */
    public function delete(int $id): bool;
}