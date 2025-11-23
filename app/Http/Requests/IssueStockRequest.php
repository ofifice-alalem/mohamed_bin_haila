<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\IssueStockToMarketerDto;
use Illuminate\Foundation\Http\FormRequest;

class IssueStockRequest extends FormRequest
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
            'quantity_taken' => 'required|integer|min:1',
            'movement_date' => 'required|date',
        ];
    }

    public function toDto(): IssueStockToMarketerDto
    {
        return new IssueStockToMarketerDto(
            marketerId: $this->integer('marketer_id'),
            productId: $this->integer('product_id'),
            quantityTaken: $this->integer('quantity_taken'),
            movementDate: $this->string('movement_date')
        );
    }
}