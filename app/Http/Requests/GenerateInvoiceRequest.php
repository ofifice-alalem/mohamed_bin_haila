<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\GenerateInvoiceDto;
use Illuminate\Foundation\Http\FormRequest;

class GenerateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => 'required|integer|exists:stores,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
        ];
    }

    public function toDto(): GenerateInvoiceDto
    {
        return new GenerateInvoiceDto(
            storeId: $this->integer('store_id'),
            periodStart: $this->string('period_start'),
            periodEnd: $this->string('period_end'),
            invoiceNumber: $this->string('invoice_number')
        );
    }
}