<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockMovementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'marketer_id' => $this->marketer_id,
            'product_id' => $this->product_id,
            'quantity_taken' => $this->quantity_taken,
            'quantity_sold' => $this->quantity_sold,
            'quantity_remaining' => $this->quantity_remaining,
            'movement_date' => $this->movement_date,
            'marketer' => $this->whenLoaded('marketer', fn() => [
                'id' => $this->marketer->id,
                'name' => $this->marketer->name,
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