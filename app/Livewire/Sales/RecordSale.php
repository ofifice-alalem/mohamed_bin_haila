<?php

declare(strict_types=1);

namespace App\Livewire\Sales;

use App\DTOs\CreateSaleDto;
use App\Services\SaleService;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class RecordSale extends Component
{
    use WithPagination;

    public int $marketerId = 0;
    public int $storeId = 0;
    public int $productId = 0;
    public int $quantity = 0;
    public float $priceAtSale = 0;
    public string $saleDate = '';
    public bool $showSuccessDialog = false;

    public function mount(): void
    {
        $this->saleDate = now()->toDateString();
    }

    public function updatedProductId(): void
    {
        if ($this->productId > 0) {
            $productRepository = app(ProductRepositoryInterface::class);
            $product = $productRepository->findById($this->productId);
            if ($product) {
                $this->priceAtSale = (float) $product->price;
            }
        }
    }

    public function recordSale(): void
    {
        $this->validate([
            'marketerId' => 'required|integer|min:1',
            'storeId' => 'required|integer|min:1',
            'productId' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'priceAtSale' => 'required|numeric|min:0',
            'saleDate' => 'required|date',
        ]);

        $dto = new CreateSaleDto(
            marketerId: $this->marketerId,
            storeId: $this->storeId,
            productId: $this->productId,
            quantity: $this->quantity,
            priceAtSale: $this->priceAtSale,
            saleDate: $this->saleDate
        );

        $saleService = app(SaleService::class);
        $sale = $saleService->recordSale($dto);

        // TODO: Send WhatsApp invoice to store
        // $this->sendWhatsAppInvoice($sale);

        $this->reset(['marketerId', 'storeId', 'productId', 'quantity', 'priceAtSale']);
        $this->saleDate = now()->toDateString();
        
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
        $storeRepository = app(StoreRepositoryInterface::class);
        $productRepository = app(ProductRepositoryInterface::class);
        $saleRepository = app(SaleRepositoryInterface::class);
        
        $marketers = $userRepository->getAllMarketers();
        $stores = $storeRepository->getAll();
        $products = $productRepository->getAll();
        $recentSales = $saleRepository->getByDate($this->saleDate);

        return view('livewire.sales.record-sale', [
            'marketers' => $marketers,
            'stores' => $stores,
            'products' => $products,
            'recentSales' => $recentSales,
        ]);
    }
}