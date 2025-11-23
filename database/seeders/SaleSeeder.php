<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Product\Product;
use App\Domains\Sale\Sale;
use App\Domains\Store\Store;
use App\Domains\User\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

/**
 * Seeder لإنشاء 50-70 عملية بيع عشوائية
 * موزعة على آخر 10 أيام مع بعض الفواتير المرسلة
 */
class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $marketers = User::where('role', UserRoleEnum::MARKETER)->get();
        $stores = Store::all();
        $products = Product::all();

        $salesCount = fake()->numberBetween(50, 70);
        $startDate = Carbon::today()->subDays(10);

        for ($i = 0; $i < $salesCount; $i++) {
            $marketer = $marketers->random();
            $store = $stores->random();
            $product = $products->random();
            
            // السعر عند البيع قد يختلف قليلاً عن السعر الأساسي
            $basePrice = (float) $product->price;
            $priceAtSale = fake()->randomFloat(2, $basePrice * 0.95, $basePrice * 1.05);
            
            $quantity = fake()->numberBetween(10, 500);
            $total = $quantity * $priceAtSale;
            
            // تاريخ البيع عشوائي في آخر 10 أيام
            $saleDate = fake()->dateTimeBetween($startDate, 'now');
            
            // 60% من المبيعات لها فواتير مرسلة
            $invoiceSent = fake()->boolean(60);

            Sale::create([
                'marketer_id' => $marketer->id,
                'store_id' => $store->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price_at_sale' => $priceAtSale,
                'total' => $total,
                'sale_date' => $saleDate,
                'invoice_sent' => $invoiceSent,
            ]);
        }
    }
}

