<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Domains\Role\Role;
use App\Domains\Sale\Sale;
use App\Domains\StockMovement\StockMovement;
use App\Domains\ReturnFromMarketer\ReturnFromMarketer;
use App\Domains\ReturnFromStore\ReturnFromStore;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'role',
        'role_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => UserRoleEnum::class,
        'password' => 'hashed',
    ];

    public function assignedRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'marketer_id');
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'marketer_id');
    }

    public function returnsFromMarketers(): HasMany
    {
        return $this->hasMany(ReturnFromMarketer::class, 'marketer_id');
    }

    public function returnsFromStores(): HasMany
    {
        return $this->hasMany(ReturnFromStore::class, 'marketer_id');
    }

    public function approvedReturnsFromMarketers(): HasMany
    {
        return $this->hasMany(ReturnFromMarketer::class, 'approved_by');
    }

    public function approvedReturnsFromStores(): HasMany
    {
        return $this->hasMany(ReturnFromStore::class, 'approved_by');
    }

    public function scopeMarketers($query)
    {
        return $query->where('role', UserRoleEnum::MARKETER);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', UserRoleEnum::ADMIN);
    }

    public function scopeByPhone($query, string $phone)
    {
        return $query->where('phone', $phone);
    }
}