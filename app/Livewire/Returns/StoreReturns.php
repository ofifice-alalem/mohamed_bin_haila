<?php

declare(strict_types=1);

namespace App\Livewire\Returns;

use App\DTOs\ApproveReturnDto;
use App\Enums\ReturnStatusEnum;
use App\Services\ReturnService;
use App\Repositories\Contracts\ReturnFromStoreRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class StoreReturns extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';

    public function __construct(
        private readonly ReturnService $returnService,
        private readonly ReturnFromStoreRepositoryInterface $returnRepository
    ) {}

    public function approveReturn(int $returnId): void
    {
        $dto = new ApproveReturnDto(
            returnId: $returnId,
            approvedBy: auth()->id(),
            status: ReturnStatusEnum::APPROVED
        );

        $this->returnService->approveReturnFromStore($dto);
        
        session()->flash('message', 'Store return approved successfully!');
    }

    public function rejectReturn(int $returnId): void
    {
        $dto = new ApproveReturnDto(
            returnId: $returnId,
            approvedBy: auth()->id(),
            status: ReturnStatusEnum::REJECTED
        );

        $this->returnService->approveReturnFromStore($dto);
        
        session()->flash('message', 'Store return rejected successfully!');
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

        return view('livewire.returns.store-returns', [
            'returns' => $returns,
        ]);
    }
}