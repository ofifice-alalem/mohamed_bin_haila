<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use App\Repositories\Contracts\ReturnFromMarketerRepositoryInterface;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $saleRepository = app(SaleRepositoryInterface::class);
        $stockMovementRepository = app(StockMovementRepositoryInterface::class);
        $returnRepository = app(ReturnFromMarketerRepositoryInterface::class);
        
        $todayDate = now()->toDateString();
        
        $todaySales = $saleRepository->getByDate($todayDate);
        $todayStockMovements = $stockMovementRepository->getByDate($todayDate);
        $pendingReturns = $returnRepository->getPending();
        
        $totalSalesToday = $todaySales->sum('total');
        $totalStockIssued = $todayStockMovements->sum('quantity_taken');

        return view('livewire.dashboard', [
            'totalSalesToday' => $totalSalesToday,
            'totalStockIssued' => $totalStockIssued,
            'pendingReturnsCount' => $pendingReturns->count(),
            'recentSales' => $todaySales->take(5),
            'recentStockMovements' => $todayStockMovements->take(5),
        ]);
    }
}