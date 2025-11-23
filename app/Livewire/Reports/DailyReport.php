<?php

declare(strict_types=1);

namespace App\Livewire\Reports;

use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use App\Repositories\Contracts\ReturnFromMarketerRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Livewire\Component;

class DailyReport extends Component
{
    public string $reportDate = '';

    public function __construct(
        private readonly SaleRepositoryInterface $saleRepository,
        private readonly StockMovementRepositoryInterface $stockMovementRepository,
        private readonly ReturnFromMarketerRepositoryInterface $returnRepository,
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function mount(): void
    {
        $this->reportDate = now()->toDateString();
    }

    public function render()
    {
        $sales = $this->saleRepository->getByDate($this->reportDate);
        $stockMovements = $this->stockMovementRepository->getByDate($this->reportDate);
        $returns = $this->returnRepository->getByStatus(\App\Enums\ReturnStatusEnum::APPROVED)
            ->filter(fn($return) => $return->approved_at?->toDateString() === $this->reportDate);

        $marketers = $this->userRepository->getAllMarketers();
        
        $reportData = $marketers->map(function ($marketer) use ($sales, $stockMovements, $returns) {
            $marketerSales = $sales->where('marketer_id', $marketer->id);
            $marketerStock = $stockMovements->where('marketer_id', $marketer->id);
            $marketerReturns = $returns->where('marketer_id', $marketer->id);

            return [
                'marketer' => $marketer,
                'total_sales' => $marketerSales->sum('total'),
                'total_quantity_sold' => $marketerSales->sum('quantity'),
                'stock_issued' => $marketerStock->sum('quantity_taken'),
                'stock_remaining' => $marketerStock->sum('quantity_remaining'),
                'returns_quantity' => $marketerReturns->sum('quantity'),
                'sales_count' => $marketerSales->count(),
            ];
        });

        $totals = [
            'total_sales_amount' => $sales->sum('total'),
            'total_stock_issued' => $stockMovements->sum('quantity_taken'),
            'total_stock_remaining' => $stockMovements->sum('quantity_remaining'),
            'total_returns' => $returns->sum('quantity'),
        ];

        return view('livewire.reports.daily-report', [
            'reportData' => $reportData,
            'totals' => $totals,
            'reportDate' => $this->reportDate,
        ]);
    }
}