<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Sale\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory لإنشاء بيانات وهمية للمبيعات
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(10, 500);
        $priceAtSale = fake()->randomFloat(2, 2.00, 20.00);
        $total = $quantity * $priceAtSale;

        return [
            'marketer_id' => 1,
            'store_id' => 1,
            'product_id' => 1,
            'quantity' => $quantity,
            'price_at_sale' => $priceAtSale,
            'total' => $total,
            'sale_date' => fake()->dateTimeBetween('-10 days', 'now'),
            'invoice_sent' => fake()->boolean(60),
        ];
    }
}


