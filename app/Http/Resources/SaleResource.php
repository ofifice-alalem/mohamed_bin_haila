<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'marketer_id' => $this->marketer_id,
            'store_id' => $this->store_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price_at_sale' => $this->price_at_sale,
            'total' => $this->total,
            'sale_date' => $this->sale_date,
            'invoice_sent' => $this->invoice_sent,
            'marketer' => $this->whenLoaded('marketer', fn() => [
                'id' => $this->marketer->id,
                'name' => $this->marketer->name,
            ]),
            'store' => $this->whenLoaded('store', fn() => [
                'id' => $this->store->id,
                'name' => $this->store->name,
            ]),
            'product' => $this->whenLoaded('product', fn() => [
                'id' => $this->product->id,
                'name' => $this->product->name,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}