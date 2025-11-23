<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\RequestReturnFromMarketerDto;
use Illuminate\Foundation\Http\FormRequest;

class RequestMarketerReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'marketer_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function toDto(): RequestReturnFromMarketerDto
    {
        return new RequestReturnFromMarketerDto(
            marketerId: $this->integer('marketer_id'),
            productId: $this->integer('product_id'),
            quantity: $this->integer('quantity'),
            notes: $this->string('notes')
        );
    }
}