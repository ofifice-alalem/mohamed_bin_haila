<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\DTOs\GenerateInvoiceDto;
use App\Services\InvoiceService;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class StoreInvoices extends Component
{
    use WithPagination;

    public int $storeId = 0;
    public string $periodStart = '';
    public string $periodEnd = '';
    public string $invoiceNumber = '';

    public function __construct(
        private readonly InvoiceService $invoiceService,
        private readonly InvoiceRepositoryInterface $invoiceRepository,
        private readonly StoreRepositoryInterface $storeRepository
    ) {}

    public function mount(): void
    {
        $this->periodStart = now()->startOfWeek()->toDateString();
        $this->periodEnd = now()->endOfWeek()->toDateString();
    }

    public function generateInvoice(): void
    {
        $this->validate([
            'storeId' => 'required|integer|min:1',
            'periodStart' => 'required|date',
            'periodEnd' => 'required|date|after_or_equal:periodStart',
            'invoiceNumber' => 'required|string',
        ]);

        $dto = new GenerateInvoiceDto(
            storeId: $this->storeId,
            periodStart: $this->periodStart,
            periodEnd: $this->periodEnd,
            invoiceNumber: $this->invoiceNumber
        );

        $invoice = $this->invoiceService->generateInvoice($dto);

        // TODO: Send WhatsApp invoice PDF
        // $this->sendWhatsAppInvoicePdf($invoice);

        $this->reset(['storeId', 'invoiceNumber']);
        $this->mount();
        
        session()->flash('message', 'Invoice generated and sent successfully!');
    }

    public function markAsSent(int $invoiceId): void
    {
        $this->invoiceService->markInvoiceAsSent($invoiceId);
        session()->flash('message', 'Invoice marked as sent!');
    }

    public function markAsPaid(int $invoiceId): void
    {
        $this->invoiceService->markInvoiceAsPaid($invoiceId);
        session()->flash('message', 'Invoice marked as paid!');
    }

    public function render()
    {
        $stores = $this->storeRepository->getAll();
        $recentInvoices = $this->invoiceRepository->getByPeriod(
            now()->subDays(30)->toDateString(),
            now()->toDateString()
        );

        return view('livewire.invoices.store-invoices', [
            'stores' => $stores,
            'recentInvoices' => $recentInvoices,
        ]);
    }
}