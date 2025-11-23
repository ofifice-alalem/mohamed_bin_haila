<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\ReturnFromMarketer\ReturnFromMarketer;
use App\Enums\ReturnStatusEnum;
use App\Repositories\Contracts\ReturnFromMarketerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentReturnFromMarketerRepository implements ReturnFromMarketerRepositoryInterface
{
    public function __construct(
        private readonly ReturnFromMarketer $returnFromMarketer
    ) {}

    public function findById(int $id): ?ReturnFromMarketer
    {
        return $this->returnFromMarketer->with(['marketer', 'product', 'approver'])->find($id);
    }

    public function getByMarketer(int $marketerId): Collection
    {
        return $this->returnFromMarketer->byMarketer($marketerId)->with(['product', 'approver'])->get();
    }

    public function getByStatus(ReturnStatusEnum $status): Collection
    {
        return $this->returnFromMarketer->byStatus($status)->with(['marketer', 'product', 'approver'])->get();
    }

    public function getPending(): Collection
    {
        return $this->returnFromMarketer->pending()->with(['marketer', 'product'])->get();
    }

    public function getApproved(): Collection
    {
        return $this->returnFromMarketer->approved()->with(['marketer', 'product', 'approver'])->get();
    }

    public function create(array $data): ReturnFromMarketer
    {
        return $this->returnFromMarketer->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->returnFromMarketer->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->returnFromMarketer->where('id', $id)->delete();
    }
}