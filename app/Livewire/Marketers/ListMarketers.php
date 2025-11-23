<?php

declare(strict_types=1);

namespace App\Livewire\Marketers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ListMarketers extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $userRepository = app(UserRepositoryInterface::class);
        $stockMovementRepository = app(StockMovementRepositoryInterface::class);
        
        $marketers = $userRepository->getAllMarketers();
        
        if ($this->search) {
            $marketers = $marketers->filter(fn($marketer) => 
                str_contains(strtolower($marketer->name), strtolower($this->search))
            );
        }

        // Get current stock for each marketer
        $marketersWithStock = $marketers->map(function ($marketer) use ($stockMovementRepository) {
            $todayStock = $stockMovementRepository->getByMarketerAndDate(
                $marketer->id, 
                now()->toDateString()
            );
            
            $marketer->current_stock = $todayStock->sum('quantity_remaining');
            return $marketer;
        });

        return view('livewire.marketers.list-marketers', [
            'marketers' => $marketersWithStock,
        ]);
    }
}