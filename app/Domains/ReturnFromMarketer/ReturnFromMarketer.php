<?php

declare(strict_types=1);

namespace App\Domains\ReturnFromMarketer;

use App\Domains\User\User;
use App\Domains\Product\Product;
use App\Enums\ReturnStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnFromMarketer extends Model
{
    protected $table = 'returns_from_marketers';

    protected $fillable = [
        'marketer_id',
        'product_id',
        'quantity',
        'status',
        'requested_at',
        'approved_at',
        'approved_by',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'status' => ReturnStatusEnum::class,
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function marketer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopeByMarketer($query, int $marketerId)
    {
        return $query->where('marketer_id', $marketerId);
    }

    public function scopeByStatus($query, ReturnStatusEnum $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', ReturnStatusEnum::PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', ReturnStatusEnum::APPROVED);
    }
}