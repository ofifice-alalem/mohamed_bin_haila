<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory لإنشاء بيانات وهمية للمنتجات
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    private const PRODUCTS = [
        ['name' => 'مكرونة', 'unit' => 'علبة', 'price' => 2.50],
        ['name' => 'زيت نباتي', 'unit' => 'زجاجة', 'price' => 8.00],
        ['name' => 'سكر', 'unit' => 'كيلو', 'price' => 3.50],
        ['name' => 'رز', 'unit' => 'كيلو', 'price' => 4.00],
        ['name' => 'تونة', 'unit' => 'علبة', 'price' => 5.50],
        ['name' => 'حليب بودرة', 'unit' => 'كيلو', 'price' => 12.00],
        ['name' => 'شاي', 'unit' => 'كيلو', 'price' => 6.00],
        ['name' => 'قهوة', 'unit' => 'كيلو', 'price' => 15.00],
        ['name' => 'دقيق', 'unit' => 'كيلو', 'price' => 2.00],
        ['name' => 'عدس', 'unit' => 'كيلو', 'price' => 3.00],
        ['name' => 'فاصوليا', 'unit' => 'كيلو', 'price' => 3.50],
        ['name' => 'معكرونة', 'unit' => 'كيلو', 'price' => 2.00],
        ['name' => 'زيتون', 'unit' => 'كيلو', 'price' => 10.00],
        ['name' => 'عسل', 'unit' => 'كيلو', 'price' => 25.00],
        ['name' => 'تمر', 'unit' => 'كيلو', 'price' => 8.00],
    ];

    public function definition(): array
    {
        $product = fake()->randomElement(self::PRODUCTS);

        return [
            'name' => $product['name'],
            'unit' => $product['unit'],
            'price' => $product['price'],
        ];
    }
}

