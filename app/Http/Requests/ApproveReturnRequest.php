<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTOs\ApproveReturnDto;
use App\Enums\ReturnStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApproveReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'return_id' => 'required|integer',
            'approved_by' => 'required|integer|exists:users,id',
            'status' => ['required', Rule::enum(ReturnStatusEnum::class)],
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function toDto(): ApproveReturnDto
    {
        return new ApproveReturnDto(
            returnId: $this->integer('return_id'),
            approvedBy: $this->integer('approved_by'),
            status: ReturnStatusEnum::from($this->string('status')),
            notes: $this->string('notes')
        );
    }
}