<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\Product\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly Product $product
    ) {}

    public function findById(int $id): ?Product
    {
        return $this->product->find($id);
    }

    public function getAll(): Collection
    {
        return $this->product->all();
    }

    public function searchByName(string $name): Collection
    {
        return $this->product->byName($name)->get();
    }

    public function getByUnit(string $unit): Collection
    {
        return $this->product->byUnit($unit)->get();
    }

    public function create(array $data): Product
    {
        return $this->product->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->product->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->product->where('id', $id)->delete();
    }
}