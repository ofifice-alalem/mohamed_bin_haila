<?php

declare(strict_types=1);

namespace App\Domains\Invoice;

use App\Domains\Store\Store;
use App\Enums\InvoiceStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'store_id',
        'invoice_number',
        'total_amount',
        'period_start',
        'period_end',
        'status',
        'pdf_path',
        'sent_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'period_start' => 'date',
        'period_end' => 'date',
        'status' => InvoiceStatusEnum::class,
        'sent_at' => 'datetime',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function scopeByStore($query, int $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    public function scopeByStatus($query, InvoiceStatusEnum $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', InvoiceStatusEnum::PENDING);
    }

    public function scopeSent($query)
    {
        return $query->where('status', InvoiceStatusEnum::SENT);
    }

    public function scopePaid($query)
    {
        return $query->where('status', InvoiceStatusEnum::PAID);
    }

    public function scopeByPeriod($query, string $startDate, string $endDate)
    {
        return $query->where('period_start', '>=', $startDate)
                    ->where('period_end', '<=', $endDate);
    }
}