<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\Store\Store;
use App\Repositories\Contracts\StoreRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentStoreRepository implements StoreRepositoryInterface
{
    public function __construct(
        private readonly Store $store
    ) {}

    public function findById(int $id): ?Store
    {
        return $this->store->find($id);
    }

    public function getAll(): Collection
    {
        return $this->store->all();
    }

    public function searchByName(string $name): Collection
    {
        return $this->store->byName($name)->get();
    }

    public function findByPhone(string $phone): ?Store
    {
        return $this->store->byPhone($phone)->first();
    }

    public function getByCreditDays(int $days): Collection
    {
        return $this->store->withCreditDays($days)->get();
    }

    public function create(array $data): Store
    {
        return $this->store->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->store->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->store->where('id', $id)->delete();
    }
}