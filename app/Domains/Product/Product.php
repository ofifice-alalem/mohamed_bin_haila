<?php

declare(strict_types=1);

namespace App\Domains\Product;

use App\Domains\Sale\Sale;
use App\Domains\StockMovement\StockMovement;
use App\Domains\ReturnFromMarketer\ReturnFromMarketer;
use App\Domains\ReturnFromStore\ReturnFromStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function returnsFromMarketers(): HasMany
    {
        return $this->hasMany(ReturnFromMarketer::class);
    }

    public function returnsFromStores(): HasMany
    {
        return $this->hasMany(ReturnFromStore::class);
    }

    public function scopeByName($query, string $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    public function scopeByUnit($query, string $unit)
    {
        return $query->where('unit', $unit);
    }
}