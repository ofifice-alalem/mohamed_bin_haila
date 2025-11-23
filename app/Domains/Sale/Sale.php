<?php

declare(strict_types=1);

namespace App\Domains\Sale;

use App\Domains\User\User;
use App\Domains\Store\Store;
use App\Domains\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'marketer_id',
        'store_id',
        'product_id',
        'quantity',
        'price_at_sale',
        'total',
        'sale_date',
        'invoice_sent',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_at_sale' => 'decimal:2',
        'total' => 'decimal:2',
        'sale_date' => 'date',
        'invoice_sent' => 'boolean',
    ];

    public function marketer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marketer_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeByMarketer($query, int $marketerId)
    {
        return $query->where('marketer_id', $marketerId);
    }

    public function scopeByStore($query, int $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    public function scopeByDate($query, string $date)
    {
        return $query->where('sale_date', $date);
    }

    public function scopeInvoiceSent($query)
    {
        return $query->where('invoice_sent', true);
    }

    public function scopeInvoiceNotSent($query)
    {
        return $query->where('invoice_sent', false);
    }
}