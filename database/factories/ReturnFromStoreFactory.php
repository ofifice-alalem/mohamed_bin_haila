<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\ReturnFromStore\ReturnFromStore;
use App\Enums\ReturnStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory لإنشاء بيانات وهمية لإرجاعات المتاجر
 */
class ReturnFromStoreFactory extends Factory
{
    protected $model = ReturnFromStore::class;

    private const REASONS = [
        'منتج تالف',
        'منتج منتهي الصلاحية',
        'كمية زائدة',
        'طلب خاطئ',
        'منتج غير مطابق للمواصفات',
    ];

    public function definition(): array
    {
        $requestedAt = fake()->dateTimeBetween('-5 days', 'now');
        $status = fake()->randomElement([ReturnStatusEnum::PENDING, ReturnStatusEnum::APPROVED, ReturnStatusEnum::REJECTED]);
        $approvedAt = ($status === ReturnStatusEnum::APPROVED) 
            ? fake()->dateTimeBetween($requestedAt, 'now') 
            : null;

        return [
            'marketer_id' => 1,
            'store_id' => 1,
            'product_id' => 1,
            'quantity' => fake()->numberBetween(5, 100),
            'reason' => fake()->randomElement(self::REASONS),
            'status' => $status,
            'requested_at' => $requestedAt,
            'approved_at' => $approvedAt,
            'approved_by' => ($status === ReturnStatusEnum::APPROVED) ? 1 : null,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}


