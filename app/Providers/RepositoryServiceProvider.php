<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Eloquent\EloquentStoreRepository;
use App\Repositories\Contracts\StockMovementRepositoryInterface;
use App\Repositories\Eloquent\EloquentStockMovementRepository;
use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Eloquent\EloquentSaleRepository;
use App\Repositories\Contracts\ReturnFromMarketerRepositoryInterface;
use App\Repositories\Eloquent\EloquentReturnFromMarketerRepository;
use App\Repositories\Contracts\ReturnFromStoreRepositoryInterface;
use App\Repositories\Eloquent\EloquentReturnFromStoreRepository;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Eloquent\EloquentInvoiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, EloquentStoreRepository::class);
        $this->app->bind(StockMovementRepositoryInterface::class, EloquentStockMovementRepository::class);
        $this->app->bind(SaleRepositoryInterface::class, EloquentSaleRepository::class);
        $this->app->bind(ReturnFromMarketerRepositoryInterface::class, EloquentReturnFromMarketerRepository::class);
        $this->app->bind(ReturnFromStoreRepositoryInterface::class, EloquentReturnFromStoreRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, EloquentInvoiceRepository::class);
    }
}