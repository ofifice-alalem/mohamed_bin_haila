<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Store\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory لإنشاء بيانات وهمية للمتاجر
 */
class StoreFactory extends Factory
{
    protected $model = Store::class;

    private const STORE_NAMES = [
        'أبو علي', 'البركة', 'الرحمة', 'النور', 'الخير',
        'الوفاء', 'الصدق', 'الأمانة', 'الفلاح', 'النجاح',
        'الفرح', 'السعادة', 'البركة الكبرى', 'الرحمة الكبرى', 'النور الكبير',
        'الخير العميم', 'الوفاء العظيم', 'الصدق المطلق', 'الأمانة الكاملة', 'الفلاح الدائم',
        'النجاح المستمر', 'الفرح الدائم', 'السعادة الأبدية', 'البركة الدائمة', 'الرحمة المستمرة',
    ];

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(self::STORE_NAMES);

        return [
            'name' => $name,
            'phone_whatsapp' => '09' . fake()->unique()->numerify('#########'),
            'address' => fake()->address(),
            'credit_days' => fake()->randomElement([7, 14, 21, 30]),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}

