<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\GenerateInvoiceDto;
use App\Domains\Invoice\Invoice;
use App\Enums\InvoiceStatusEnum;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Service for managing invoice generation and operations
 */
class InvoiceService
{
    public function __construct(
        private readonly InvoiceRepositoryInterface $invoiceRepository,
        private readonly StoreRepositoryInterface $storeRepository,
        private readonly SaleRepositoryInterface $saleRepository,
        private readonly SaleService $saleService
    ) {}

    /**
     * Generate invoice for store sales in specific period
     */
    public function generateInvoice(GenerateInvoiceDto $dto): Invoice
    {
        return DB::transaction(function () use ($dto) {
            $store = $this->storeRepository->findById($dto->storeId);
            if (!$store) {
                throw new \InvalidArgumentException('Store not found');
            }

            $sales = $this->getSalesForPeriod($dto->storeId, $dto->periodStart, $dto->periodEnd);
            
            if ($sales->isEmpty()) {
                throw new \Exception('No sales found for the specified period');
            }

            $totalAmount = $sales->sum('total');
            $saleIds = $sales->pluck('id')->toArray();

            $invoice = $this->invoiceRepository->create([
                'store_id' => $dto->storeId,
                'invoice_number' => $dto->invoiceNumber,
                'total_amount' => $totalAmount,
                'period_start' => $dto->periodStart,
                'period_end' => $dto->periodEnd,
                'status' => InvoiceStatusEnum::PENDING,
            ]);

            $this->saleService->markInvoiceSent($saleIds);

            return $invoice;
        });
    }

    /**
     * Mark invoice as sent
     */
    public function markInvoiceAsSent(int $invoiceId): bool
    {
        return $this->invoiceRepository->update($invoiceId, [
            'status' => InvoiceStatusEnum::SENT,
            'sent_at' => now(),
        ]);
    }

    /**
     * Mark invoice as paid
     */
    public function markInvoiceAsPaid(int $invoiceId): bool
    {
        return $this->invoiceRepository->update($invoiceId, [
            'status' => InvoiceStatusEnum::PAID,
        ]);
    }

    /**
     * Get sales for specific store and period
     */
    private function getSalesForPeriod(int $storeId, string $startDate, string $endDate)
    {
        return $this->saleRepository->getByStore($storeId)
            ->whereBetween('sale_date', [$startDate, $endDate])
            ->where('invoice_sent', false);
    }
}