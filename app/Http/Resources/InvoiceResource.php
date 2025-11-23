<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'invoice_number' => $this->invoice_number,
            'total_amount' => $this->total_amount,
            'period_start' => $this->period_start,
            'period_end' => $this->period_end,
            'status' => $this->status,
            'pdf_path' => $this->pdf_path,
            'sent_at' => $this->sent_at,
            'store' => $this->whenLoaded('store', fn() => [
                'id' => $this->store->id,
                'name' => $this->store->name,
                'phone_whatsapp' => $this->store->phone_whatsapp,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}