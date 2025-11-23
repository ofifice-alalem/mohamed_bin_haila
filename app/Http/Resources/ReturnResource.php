<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReturnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'marketer_id' => $this->marketer_id,
            'store_id' => $this->when(isset($this->store_id), $this->store_id),
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'reason' => $this->when(isset($this->reason), $this->reason),
            'status' => $this->status,
            'requested_at' => $this->requested_at,
            'approved_at' => $this->approved_at,
            'approved_by' => $this->approved_by,
            'notes' => $this->notes,
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
            'approver' => $this->whenLoaded('approver', fn() => [
                'id' => $this->approver->id,
                'name' => $this->approver->name,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}