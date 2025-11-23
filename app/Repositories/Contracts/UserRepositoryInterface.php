<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\User\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Find user by ID
     */
    public function findById(int $id): ?User;

    /**
     * Find user by phone
     */
    public function findByPhone(string $phone): ?User;

    /**
     * Get all marketers
     */
    public function getAllMarketers(): Collection;

    /**
     * Get all admins
     */
    public function getAllAdmins(): Collection;

    /**
     * Create new user
     */
    public function create(array $data): User;

    /**
     * Update user
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete user
     */
    public function delete(int $id): bool;
}