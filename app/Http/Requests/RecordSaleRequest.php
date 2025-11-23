<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\CreateSaleDto;
use Illuminate\Foundation\Http\FormRequest;

class RecordSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'marketer_id' => 'required|integer|exists:users,id',
            'store_id' => 'required|integer|exists:stores,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price_at_sale' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ];
    }

    public function toDto(): CreateSaleDto
    {
        return new CreateSaleDto(
            marketerId: $this->integer('marketer_id'),
            storeId: $this->integer('store_id'),
            productId: $this->integer('product_id'),
            quantity: $this->integer('quantity'),
            priceAtSale: $this->float('price_at_sale'),
            saleDate: $this->string('sale_date')
        );
    }
}