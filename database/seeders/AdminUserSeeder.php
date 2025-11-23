<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Role\Role;
use App\Domains\User\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder لإنشاء مستخدم Admin الرئيسي
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['phone' => '0910000000'],
            [
                'name' => 'محمد',
                'email' => 'mohamed@admin.com',
                'role' => UserRoleEnum::ADMIN,
                'role_id' => $adminRole?->id,
                'password' => Hash::make('password'),
            ]
        );
    }
}

