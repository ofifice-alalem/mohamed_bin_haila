<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatusEnum: string
{
    case SENT = 'sent';
    case PAID = 'paid';
    case PENDING = 'pending';
}