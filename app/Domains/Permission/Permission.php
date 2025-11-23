<?php

declare(strict_types=1);

namespace App\Domains\Permission;

use App\Domains\Role\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'display_name',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    public function scopeByName($query, string $name)
    {
        return $query->where('name', $name);
    }
}