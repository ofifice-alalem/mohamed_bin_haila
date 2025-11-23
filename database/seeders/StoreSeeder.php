<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Store\Store;
use Illuminate\Database\Seeder;

/**
 * Seeder لإنشاء 25 متجر بأسماء ليبية واقعية
 */
class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            ['name' => 'أبو علي', 'phone' => '0912345678'],
            ['name' => 'البركة', 'phone' => '0912345679'],
            ['name' => 'الرحمة', 'phone' => '0912345680'],
            ['name' => 'النور', 'phone' => '0912345681'],
            ['name' => 'الخير', 'phone' => '0912345682'],
            ['name' => 'الوفاء', 'phone' => '0912345683'],
            ['name' => 'الصدق', 'phone' => '0912345684'],
            ['name' => 'الأمانة', 'phone' => '0912345685'],
            ['name' => 'الفلاح', 'phone' => '0912345686'],
            ['name' => 'النجاح', 'phone' => '0912345687'],
            ['name' => 'الفرح', 'phone' => '0912345688'],
            ['name' => 'السعادة', 'phone' => '0912345689'],
            ['name' => 'البركة الكبرى', 'phone' => '0912345690'],
            ['name' => 'الرحمة الكبرى', 'phone' => '0912345691'],
            ['name' => 'النور الكبير', 'phone' => '0912345692'],
            ['name' => 'الخير العميم', 'phone' => '0912345693'],
            ['name' => 'الوفاء العظيم', 'phone' => '0912345694'],
            ['name' => 'الصدق المطلق', 'phone' => '0912345695'],
            ['name' => 'الأمانة الكاملة', 'phone' => '0912345696'],
            ['name' => 'الفلاح الدائم', 'phone' => '0912345697'],
            ['name' => 'النجاح المستمر', 'phone' => '0912345698'],
            ['name' => 'الفرح الدائم', 'phone' => '0912345699'],
            ['name' => 'السعادة الأبدية', 'phone' => '0912345700'],
            ['name' => 'البركة الدائمة', 'phone' => '0912345701'],
            ['name' => 'الرحمة المستمرة', 'phone' => '0912345702'],
        ];

        foreach ($stores as $store) {
            Store::firstOrCreate(
                ['phone_whatsapp' => $store['phone']],
                [
                    'name' => $store['name'],
                    'address' => 'طرابلس - ليبيا',
                    'credit_days' => fake()->randomElement([7, 14, 21, 30]),
                    'notes' => null,
                ]
            );
        }
    }
}

