<?php

declare(strict_types=1);

namespace App\DTOs;

class IssueStockToMarketerDto
{
    public function __construct(
        public readonly int $marketerId,
        public readonly int $productId,
        public readonly int $quantityTaken,
        public readonly string $movementDate
    ) {}
}