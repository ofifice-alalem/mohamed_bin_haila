<?php

declare(strict_types=1);

use App\Http\Controllers\IssueStockController;
use App\Http\Controllers\RecordSaleController;
use App\Http\Controllers\RequestMarketerReturnController;
use App\Http\Controllers\RequestStoreReturnController;
use App\Http\Controllers\ApproveReturnController;
use App\Http\Controllers\GenerateInvoiceController;
use Illuminate\Support\Facades\Route;

Route::post('/stock/issue', IssueStockController::class);
Route::post('/sales', RecordSaleController::class);
Route::post('/returns/marketer', RequestMarketerReturnController::class);
Route::post('/returns/store', RequestStoreReturnController::class);
Route::post('/returns/approve', ApproveReturnController::class);
Route::post('/invoices/generate', GenerateInvoiceController::class);