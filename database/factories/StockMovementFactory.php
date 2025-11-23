<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\StockMovement\StockMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory لإنشاء بيانات وهمية لحركات المخزون
 */
class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    public function definition(): array
    {
        $quantityTaken = fake()->numberBetween(100, 2000);
        $quantitySold = fake()->numberBetween(0, (int) ($quantityTaken * 0.8));
        $quantityRemaining = $quantityTaken - $quantitySold;

        return [
            'marketer_id' => 1,
            'product_id' => 1,
            'quantity_taken' => $quantityTaken,
            'quantity_sold' => $quantitySold,
            'quantity_remaining' => $quantityRemaining,
            'movement_date' => fake()->dateTimeBetween('-10 days', 'now'),
        ];
    }
}


