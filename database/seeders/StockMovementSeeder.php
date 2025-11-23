<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Product\Product;
use App\Domains\StockMovement\StockMovement;
use App\Domains\User\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

/**
 * Seeder لإنشاء حركات مخزون واقعية لكل مسوق
 * يعطي كل مسوق كميات واقعية من المنتجات اليوم
 */
class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $marketers = User::where('role', UserRoleEnum::MARKETER)->get();
        $products = Product::all();
        $today = Carbon::today();

        // كميات واقعية لكل منتج لكل مسوق
        $stockDistribution = [
            'مكرونة' => ['min' => 500, 'max' => 1500],
            'زيت نباتي' => ['min' => 100, 'max' => 400],
            'سكر' => ['min' => 200, 'max' => 800],
            'رز' => ['min' => 200, 'max' => 800],
            'تونة' => ['min' => 50, 'max' => 200],
            'حليب بودرة' => ['min' => 30, 'max' => 100],
            'شاي' => ['min' => 50, 'max' => 200],
            'قهوة' => ['min' => 20, 'max' => 80],
            'دقيق' => ['min' => 300, 'max' => 1000],
            'عدس' => ['min' => 100, 'max' => 400],
            'فاصوليا' => ['min' => 100, 'max' => 400],
            'معكرونة' => ['min' => 500, 'max' => 1500],
            'زيتون' => ['min' => 50, 'max' => 200],
            'عسل' => ['min' => 10, 'max' => 50],
            'تمر' => ['min' => 50, 'max' => 200],
        ];

        foreach ($marketers as $marketer) {
            foreach ($products as $product) {
                $distribution = $stockDistribution[$product->name] ?? ['min' => 100, 'max' => 500];
                $quantityTaken = fake()->numberBetween($distribution['min'], $distribution['max']);
                
                // بعض المنتجات تم بيع جزء منها
                $quantitySold = fake()->numberBetween(0, (int) ($quantityTaken * 0.7));
                $quantityRemaining = $quantityTaken - $quantitySold;

                StockMovement::create([
                    'marketer_id' => $marketer->id,
                    'product_id' => $product->id,
                    'quantity_taken' => $quantityTaken,
                    'quantity_sold' => $quantitySold,
                    'quantity_remaining' => $quantityRemaining,
                    'movement_date' => $today,
                ]);
            }
        }
    }
}

