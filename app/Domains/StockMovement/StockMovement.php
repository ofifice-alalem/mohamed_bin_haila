<?php

declare(strict_types=1);

namespace App\Domains\StockMovement;

use App\Domains\User\User;
use App\Domains\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'marketer_id',
        'product_id',
        'quantity_taken',
        'quantity_sold',
        'quantity_remaining',
        'movement_date',
    ];

    protected $casts = [
        'quantity_taken' => 'integer',
        'quantity_sold' => 'integer',
        'quantity_remaining' => 'integer',
        'movement_date' => 'date',
    ];

    public function marketer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketer_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeByMarketer($query, int $marketerId)
    {
        return $query->where('marketer_id', $marketerId);
    }

    public function scopeByProduct($query, int $productId)
    {
        return $query->where('product_id', $productId);
    }

    public function scopeByDate($query, string $date)
    {
        return $query->where('movement_date', $date);
    }

    public function scopeWithRemaining($query)
    {
        return $query->where('quantity_remaining', '>', 0);
    }
}