<?php

declare(strict_types=1);

namespace App\DTOs;

class RequestReturnFromMarketerDto
{
    public function __construct(
        public readonly int $marketerId,
        public readonly int $productId,
        public readonly int $quantity,
        public readonly ?string $notes = null
    ) {}
}