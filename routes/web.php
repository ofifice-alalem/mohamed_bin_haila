<?php

declare(strict_types=1);

use App\Livewire\Dashboard;
use App\Livewire\Marketers\ListMarketers;
use App\Livewire\Stock\IssueStock;
use App\Livewire\Sales\RecordSale;
use App\Livewire\Returns\MarketerReturns;
use App\Livewire\Returns\StoreReturns;
use App\Livewire\Invoices\StoreInvoices;
use App\Livewire\Reports\DailyReport;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/marketers', ListMarketers::class)->name('marketers.list');
Route::get('/stock/issue', IssueStock::class)->name('stock.issue');
Route::get('/sales/record', RecordSale::class)->name('sales.record');
Route::get('/returns/marketers', MarketerReturns::class)->name('returns.marketers');
Route::get('/returns/stores', StoreReturns::class)->name('returns.stores');
Route::get('/invoices/stores', StoreInvoices::class)->name('invoices.stores');
Route::get('/reports/daily', DailyReport::class)->name('reports.daily');