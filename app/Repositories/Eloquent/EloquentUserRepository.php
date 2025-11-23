<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domains\User\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly User $user
    ) {}

    public function findById(int $id): ?User
    {
        return $this->user->with(['assignedRole', 'roles'])->find($id);
    }

    public function findByPhone(string $phone): ?User
    {
        return $this->user->byPhone($phone)->first();
    }

    public function getAllMarketers(): Collection
    {
        return $this->user->marketers()->with('assignedRole')->get();
    }

    public function getAllAdmins(): Collection
    {
        return $this->user->admins()->with('assignedRole')->get();
    }

    public function create(array $data): User
    {
        return $this->user->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->user->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->user->where('id', $id)->delete();
    }
}