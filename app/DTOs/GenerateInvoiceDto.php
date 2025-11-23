<?php

declare(strict_types=1);

namespace App\DTOs;

class GenerateInvoiceDto
{
    public function __construct(
        public readonly int $storeId,
        public readonly string $periodStart,
        public readonly string $periodEnd,
        public readonly string $invoiceNumber
    ) {}
}