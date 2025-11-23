<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\ReturnFromStore\ReturnFromStore;
use App\Enums\ReturnStatusEnum;
use App\Repositories\Contracts\ReturnFromStoreRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentReturnFromStoreRepository implements ReturnFromStoreRepositoryInterface
{
    public function __construct(
        private readonly ReturnFromStore $returnFromStore
    ) {}

    public function findById(int $id): ?ReturnFromStore
    {
        return $this->returnFromStore->with(['marketer', 'store', 'product', 'approver'])->find($id);
    }

    public function getByMarketer(int $marketerId): Collection
    {
        return $this->returnFromStore->byMarketer($marketerId)->with(['store', 'product', 'approver'])->get();
    }

    public function getByStore(int $storeId): Collection
    {
        return $this->returnFromStore->byStore($storeId)->with(['marketer', 'product', 'approver'])->get();
    }

    public function getByStatus(ReturnStatusEnum $status): Collection
    {
        return $this->returnFromStore->byStatus($status)->with(['marketer', 'store', 'product', 'approver'])->get();
    }

    public function getPending(): Collection
    {
        return $this->returnFromStore->pending()->with(['marketer', 'store', 'product'])->get();
    }

    public function getApproved(): Collection
    {
        return $this->returnFromStore->approved()->with(['marketer', 'store', 'product', 'approver'])->get();
    }

    public function create(array $data): ReturnFromStore
    {
        return $this->returnFromStore->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->returnFromStore->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->returnFromStore->where('id', $id)->delete();
    }
}