<?php

declare(strict_types=1);

namespace App\Livewire\Returns;

use App\DTOs\ApproveReturnDto;
use App\Enums\ReturnStatusEnum;
use App\Services\ReturnService;
use App\Repositories\Contracts\ReturnFromMarketerRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class MarketerReturns extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';



    public function approveReturn(int $returnId): void
    {
        $dto = new ApproveReturnDto(
            returnId: $returnId,
            approvedBy: auth()->id(),
            status: ReturnStatusEnum::APPROVED
        );

        $this->returnService->approveReturnFromMarketer($dto);
        
        session()->flash('message', 'Return approved successfully!');
    }

    public function rejectReturn(int $returnId): void
    {
        $dto = new ApproveReturnDto(
            returnId: $returnId,
            approvedBy: auth()->id(),
            status: ReturnStatusEnum::REJECTED
        );

        $this->returnService->approveReturnFromMarketer($dto);
        
        session()->flash('message', 'Return rejected successfully!');
    }

    public function render()
    {
        $returns = match ($this->statusFilter) {
            'pending' => $this->returnRepository->getPending(),
            'approved' => $this->returnRepository->getApproved(),
            default => $this->returnRepository->getByStatus(ReturnStatusEnum::PENDING)
                ->merge($this->returnRepository->getByStatus(ReturnStatusEnum::APPROVED))
                ->merge($this->returnRepository->getByStatus(ReturnStatusEnum::REJECTED))
        };

        return view('livewire.returns.marketer-returns', [
            'returns' => $returns,
        ]);
    }
}