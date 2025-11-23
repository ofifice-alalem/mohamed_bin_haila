<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\ReturnStatusEnum;

class ApproveReturnDto
{
    public function __construct(
        public readonly int $returnId,
        public readonly int $approvedBy,
        public readonly ReturnStatusEnum $status,
        public readonly ?string $notes = null
    ) {}
}