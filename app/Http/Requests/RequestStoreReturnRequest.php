<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\RequestReturnFromStoreDto;
use Illuminate\Foundation\Http\FormRequest;

class RequestStoreReturnRequest extends FormRequest
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
            'reason' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function toDto(): RequestReturnFromStoreDto
    {
        return new RequestReturnFromStoreDto(
            marketerId: $this->integer('marketer_id'),
            storeId: $this->integer('store_id'),
            productId: $this->integer('product_id'),
            quantity: $this->integer('quantity'),
            reason: $this->string('reason'),
            notes: $this->string('notes')
        );
    }
}