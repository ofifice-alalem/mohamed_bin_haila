<?php

declare(strict_types=1);

namespace App\Livewire\Stock;

use App\DTOs\IssueStockToMarketerDto;
use App\Services\StockMovementService;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class IssueStock extends Component
{
    use WithPagination;

    public int $marketerId = 0;
    public int $productId = 0;
    public int $quantityTaken = 0;
    public string $movementDate = '';
    public bool $showSuccessDialog = false;

    public function mount(): void
    {
        $this->movementDate = now()->toDateString();
    }

    public function issueStock(): void
    {
        $this->validate([
            'marketerId' => 'required|integer|min:1',
            'productId' => 'required|integer|min:1',
            'quantityTaken' => 'required|integer|min:1',
            'movementDate' => 'required|date',
        ]);

        $dto = new IssueStockToMarketerDto(
            marketerId: $this->marketerId,
            productId: $this->productId,
            quantityTaken: $this->quantityTaken,
            movementDate: $this->movementDate
        );

        $stockMovementService = app(StockMovementService::class);
        $stockMovementService->issueStockToMarketer($dto);

        $this->reset(['marketerId', 'productId', 'quantityTaken']);
        $this->movementDate = now()->toDateString();
        
        $this->showSuccessDialog = true;
        $this->dispatch('show-success-dialog');
    }

    public function closeDialog(): void
    {
        $this->showSuccessDialog = false;
    }

    public function render()
    {
        $userRepository = app(UserRepositoryInterface::class);
        $productRepository = app(ProductRepositoryInterface::class);
        $stockMovementRepository = app(StockMovementRepositoryInterface::class);
        
        $marketers = $userRepository->getAllMarketers();
        $products = $productRepository->getAll();
        $recentMovements = $stockMovementRepository->getByDate($this->movementDate);

        // تجميع الحركات حسب المسوق
        $movementsByMarketer = $recentMovements->groupBy('marketer_id')->map(function ($movements) {
            return [
                'marketer' => $movements->first()->marketer,
                'movements' => $movements,
                'total_quantity_taken' => $movements->sum('quantity_taken'),
                'total_quantity_remaining' => $movements->sum('quantity_remaining'),
            ];
        });

        return view('livewire.stock.issue-stock', [
            'marketers' => $marketers,
            'products' => $products,
            'movementsByMarketer' => $movementsByMarketer,
        ]);
    }
}