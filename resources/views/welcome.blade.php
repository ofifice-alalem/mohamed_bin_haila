@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">لوحة التحكم</h1>
            <p class="mt-1 text-sm text-gray-600">مرحباً بك في نظام إدارة المخزون</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->locale('ar')->translatedFormat('l، j F Y') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- إجمالي المنتجات -->
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-xl p-3">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="mr-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">إجمالي المنتجات</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalProducts ?? 0 }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                        عرض الكل ←
                    </a>
                </div>
            </div>
        </div>

        <!-- المسوقين النشطين -->
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-xl p-3">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">المسوقين النشطين</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $activeMarketers ?? 0 }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('marketers.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700">
                        عرض الكل ←
                    </a>
                </div>
            </div>
        </div>

        <!-- المبيعات اليوم -->
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-xl p-3">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">مبيعات اليوم</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($todaySales ?? 0) }}</p>
                        <p class="text-xs text-gray-500 mt-1">ريال</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('sales.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">
                        عرض التفاصيل ←
                    </a>
                </div>
            </div>
        </div>

        <!-- الفواتير المعلقة -->
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-orange-100 rounded-xl p-3">
                        <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="mr-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">فواتير معلقة</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $pendingInvoices ?? 0 }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('invoices.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-700">
                        عرض الكل ←
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- المبيعات الأسبوعية -->
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">المبيعات الأسبوعية</h3>
                    <span class="text-sm text-gray-500">آخر 7 أيام</span>
                </div>
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                    <p class="text-gray-500">الرسم البياني قيد التطوير</p>
                </div>
            </div>
        </div>

        <!-- أفضل المنتجات مبيعاً -->
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">أفضل المنتجات مبيعاً</h3>
                    <a href="{{ route('reports.index') }}" class="text-sm text-blue-600 hover:text-blue-700">عرض التقرير</a>
                </div>
                <div class="space-y-4">
                    @forelse($topProducts ?? [] as $product)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center">
                                <span class="text-xs font-medium text-gray-700">{{ $loop->iteration }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->category->name ?? 'غير مصنف' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ number_format($product->total_sales ?? 0) }} ريال</p>
                            <p class="text-xs text-gray-500">{{ $product->quantity_sold ?? 0 }} وحدة</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-500 py-4">لا توجد بيانات متاحة</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                                <span class="text-blue-600 font-bold">{{ $loop->iteration }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">{{ $product->sales_count }} مبيعة</p>
                            </div>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-gray-900">{{ number_format($product->total_sales) }} ريال</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">لا توجد بيانات متاحة</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white overflow-hidden shadow-lg rounded-2xl">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">آخر العمليات</h3>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700">عرض الكل</a>
            </div>
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    @forelse($recentActivities ?? [] as $activity)
                    <li>
                        <div class="relative pb-8">
                            @if(!$loop->last)
                            <span class="absolute top-4 right-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3 space-x-reverse">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                    <div>
                                        <p class="text-sm text-gray-900">{{ $activity->description }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">بواسطة {{ $activity->user_name }}</p>
                                    </div>
                                    <div class="whitespace-nowrap text-left text-sm text-gray-500">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">لا توجد عمليات حديثة</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-white mb-4">إجراءات سريعة</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('products.create') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm rounded-xl p-4 text-center transition-all duration-200 hover:scale-105">
                <svg class="mx-auto h-8 w-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span class="text-white text-sm font-medium">إضافة منتج</span>
            </a>
            
            <a href="{{ route('marketers.create') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm rounded-xl p-4 text-center transition-all duration-200 hover:scale-105">
                <svg class="mx-auto h-8 w-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span class="text-white text-sm font-medium">إضافة مسوق</span>
            </a>
            
            <a href="{{ route('stock.issue') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm rounded-xl p-4 text-center transition-all duration-200 hover:scale-105">
                <svg class="mx-auto h-8 w-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <span class="text-white text-sm font-medium">إعطاء بضاعة</span>
            </a>
            
            <a href="{{ route('reports.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm rounded-xl p-4 text-center transition-all duration-200 hover:scale-105">
                <svg class="mx-auto h-8 w-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-white text-sm font-medium">التقارير</span>
            </a>
        </div>
    </div>
</div>
@endsection