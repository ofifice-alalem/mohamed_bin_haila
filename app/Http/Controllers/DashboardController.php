<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\MarketerRepositoryInterface;
use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private MarketerRepositoryInterface $marketerRepository,
        private SaleRepositoryInterface $saleRepository,
        private InvoiceRepositoryInterface $invoiceRepository
    ) {}

    public function index()
    {
        // إحصائيات عامة
        $totalProducts = $this->productRepository->count();
        $activeMarketers = $this->marketerRepository->getActiveCount();
        
        // مبيعات اليوم
        $todaySales = $this->saleRepository->getTodayTotal();
        
        // الفواتير المعلقة
        $pendingInvoices = $this->invoiceRepository->getPendingCount();
        
        // أفضل المنتجات مبيعاً
        $topProducts = $this->saleRepository->getTopSellingProducts(5);
        
        // آخر العمليات
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', compact(
            'totalProducts',
            'activeMarketers',
            'todaySales',
            'pendingInvoices',
            'topProducts',
            'recentActivities'
        ));
    }

    private function getRecentActivities()
    {
        // يمكنك تخصيص هذه الطريقة لجلب أحدث الأنشطة
        // مثال: المبيعات الأخيرة، الفواتير المضافة، إلخ
        return [];
    }
}
