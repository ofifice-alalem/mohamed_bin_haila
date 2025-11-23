<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Domains\ReturnFromMarketer\ReturnFromMarketer;
use App\Enums\ReturnStatusEnum;
use Illuminate\Database\Eloquent\Collection;

interface ReturnFromMarketerRepositoryInterface
{
    /**
     * Find return by ID
     */
    public function findById(int $id): ?ReturnFromMarketer;

    /**
     * Get returns by marketer
     */
    public function getByMarketer(int $marketerId): Collection;

    /**
     * Get returns by status
     */
    public function getByStatus(ReturnStatusEnum $status): Collection;

    /**
     * Get pending returns
     */
    public function getPending(): Collection;

    /**
     * Get approved returns
     */
    public function getApproved(): Collection;

    /**
     * Create new return
     */
    public function create(array $data): ReturnFromMarketer;

    /**
     * Update return
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete return
     */
    public function delete(int $id): bool;
}