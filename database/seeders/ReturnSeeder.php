<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Product\Product;
use App\Domains\ReturnFromMarketer\ReturnFromMarketer;
use App\Domains\ReturnFromStore\ReturnFromStore;
use App\Domains\Store\Store;
use App\Domains\User\User;
use App\Enums\ReturnStatusEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

/**
 * Seeder لإنشاء طلبات إرجاع:
 * - 5 طلبات إرجاع من مسوقين (بعضها معلقة وبعضها موافق عليها)
 * - 3 طلبات إرجاع من محلات (بعضها معلقة وبعضها موافق عليها)
 */
class ReturnSeeder extends Seeder
{
    public function run(): void
    {
        $marketers = User::where('role', UserRoleEnum::MARKETER)->get();
        $stores = Store::all();
        $products = Product::all();
        $admin = User::where('role', UserRoleEnum::ADMIN)->first();

        $reasons = [
            'منتج تالف',
            'منتج منتهي الصلاحية',
            'كمية زائدة',
            'طلب خاطئ',
            'منتج غير مطابق للمواصفات',
        ];

        // إرجاعات من المسوقين (5 طلبات)
        for ($i = 0; $i < 5; $i++) {
            $marketer = $marketers->random();
            $product = $products->random();
            $requestedAt = fake()->dateTimeBetween('-5 days', 'now');
            
            // 60% موافق عليها، 40% معلقة
            $status = fake()->boolean(60) ? ReturnStatusEnum::APPROVED : ReturnStatusEnum::PENDING;
            $approvedAt = ($status === ReturnStatusEnum::APPROVED) 
                ? fake()->dateTimeBetween($requestedAt, 'now') 
                : null;

            ReturnFromMarketer::create([
                'marketer_id' => $marketer->id,
                'product_id' => $product->id,
                'quantity' => fake()->numberBetween(10, 200),
                'status' => $status,
                'requested_at' => $requestedAt,
                'approved_at' => $approvedAt,
                'approved_by' => ($status === ReturnStatusEnum::APPROVED) ? $admin?->id : null,
                'notes' => fake()->optional()->sentence(),
            ]);
        }

        // إرجاعات من المتاجر (3 طلبات)
        for ($i = 0; $i < 3; $i++) {
            $marketer = $marketers->random();
            $store = $stores->random();
            $product = $products->random();
            $requestedAt = fake()->dateTimeBetween('-5 days', 'now');
            
            // 50% موافق عليها، 50% معلقة
            $status = fake()->boolean(50) ? ReturnStatusEnum::APPROVED : ReturnStatusEnum::PENDING;
            $approvedAt = ($status === ReturnStatusEnum::APPROVED) 
                ? fake()->dateTimeBetween($requestedAt, 'now') 
                : null;

            ReturnFromStore::create([
                'marketer_id' => $marketer->id,
                'store_id' => $store->id,
                'product_id' => $product->id,
                'quantity' => fake()->numberBetween(5, 100),
                'reason' => fake()->randomElement($reasons),
                'status' => $status,
                'requested_at' => $requestedAt,
                'approved_at' => $approvedAt,
                'approved_by' => ($status === ReturnStatusEnum::APPROVED) ? $admin?->id : null,
                'notes' => fake()->optional()->sentence(),
            ]);
        }
    }
}

