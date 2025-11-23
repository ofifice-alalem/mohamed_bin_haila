<?php

declare(strict_types=1);

namespace App\Domains\Store;

use App\Domains\Sale\Sale;
use App\Domains\ReturnFromStore\ReturnFromStore;
use App\Domains\Invoice\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone_whatsapp',
        'address',
        'credit_days',
        'notes',
    ];

    protected $casts = [
        'credit_days' => 'integer',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function returnsFromStores(): HasMany
    {
        return $this->hasMany(ReturnFromStore::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeByName($query, string $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    public function scopeByPhone($query, string $phone)
    {
        return $query->where('phone_whatsapp', $phone);
    }

    public function scopeWithCreditDays($query, int $days)
    {
        return $query->where('credit_days', $days);
    }
}