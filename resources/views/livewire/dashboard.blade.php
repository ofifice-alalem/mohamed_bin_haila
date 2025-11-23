<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">$</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">مبيعات اليوم</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ number_format($totalSalesToday, 2) }} ريال</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">#</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">بضاعة مُعطاة اليوم</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalStockIssued }} قطعة</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">!</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">إرجاعات معلقة</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $pendingReturnsCount }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Sales -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">آخر المبيعات</h3>
                        <div class="space-y-3">
                            @forelse($recentSales as $sale)
                                <div class="flex justify-between items-center py-2 border-b">
                                    <div>
                                        <p class="text-sm font-medium">{{ $sale->product->name ?? 'منتج' }}</p>
                                        <p class="text-xs text-gray-500">{{ $sale->store->name ?? 'محل' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">{{ number_format($sale->total, 2) }} ريال</p>
                                        <p class="text-xs text-gray-500">{{ $sale->quantity }} قطعة</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">لا توجد مبيعات اليوم</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Stock Movements -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">آخر حركات المخزون</h3>
                        <div class="space-y-3">
                            @forelse($recentStockMovements as $movement)
                                <div class="flex justify-between items-center py-2 border-b">
                                    <div>
                                        <p class="text-sm font-medium">{{ $movement->product->name ?? 'منتج' }}</p>
                                        <p class="text-xs text-gray-500">{{ $movement->marketer->name ?? 'مسوق' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">{{ $movement->quantity_taken }} قطعة</p>
                                        <p class="text-xs text-gray-500">متبقي: {{ $movement->quantity_remaining }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">لا توجد حركات مخزون اليوم</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>