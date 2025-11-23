<?php

declare(strict_types=1);

namespace App\DTOs;

class RequestReturnFromStoreDto
{
    public function __construct(
        public readonly int $marketerId,
        public readonly int $storeId,
        public readonly int $productId,
        public readonly int $quantity,
        public readonly ?string $reason = null,
        public readonly ?string $notes = null
    ) {}
}