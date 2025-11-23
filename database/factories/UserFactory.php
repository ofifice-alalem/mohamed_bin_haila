<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\User\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * Factory لإنشاء بيانات وهمية للمستخدمين
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => '09' . fake()->numerify('#########'),
            'role' => UserRoleEnum::MARKETER,
            'role_id' => null,
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    /**
     * حالة: مستخدم بصلاحية Admin
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRoleEnum::ADMIN,
        ]);
    }

    /**
     * حالة: مستخدم بصلاحية Marketer
     */
    public function marketer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRoleEnum::MARKETER,
        ]);
    }
}
