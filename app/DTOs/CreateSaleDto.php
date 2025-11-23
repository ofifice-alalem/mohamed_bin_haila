<?php

declare(strict_types=1);

namespace App\DTOs;

class CreateSaleDto
{
    public function __construct(
        public readonly int $marketerId,
        public readonly int $storeId,
        public readonly int $productId,
        public readonly int $quantity,
        public readonly float $priceAtSale,
        public readonly string $saleDate
    ) {}
}