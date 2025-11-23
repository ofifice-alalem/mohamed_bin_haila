<div>
    <!-- Success Dialog -->
    @if($showSuccessDialog)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
             id="success-dialog"
             wire:click="closeDialog"
             style="display: flex; align-items: center; justify-content: center;">
            <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" 
                 onclick="event.stopPropagation();">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-5">تم بنجاح!</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            تم تسجيل المبيعة بنجاح
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button wire:click="closeDialog" 
                                onclick="event.stopPropagation();"
                                class="px-4 py-2 bg-indigo-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            موافق
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    @this.closeDialog();
                }
            });
        </script>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Record Sale Form -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">تسجيل مبيعة</h3>
                
                <form wire:submit="recordSale" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">المسوق</label>
                        <select wire:model="marketerId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">اختر المسوق</option>
                            @foreach($marketers as $marketer)
                                <option value="{{ $marketer->id }}">{{ $marketer->name }}</option>
                            @endforeach
                        </select>
                        @error('marketerId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">المتجر</label>
                        <select wire:model="storeId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">اختر المتجر</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                        @error('storeId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">المنتج</label>
                        <select wire:model="productId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">اختر المنتج</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->unit }}) - {{ number_format($product->price, 2) }} د.ل</option>
                            @endforeach
                        </select>
                        @error('productId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">الكمية</label>
                        <input wire:model="quantity" type="number" min="1" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">سعر البيع (د.ل)</label>
                        <input wire:model="priceAtSale" type="number" step="0.01" min="0" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('priceAtSale') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">تاريخ البيع</label>
                        <input wire:model="saleDate" type="date" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('saleDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        تسجيل المبيعة
                    </button>
                </form>
            </div>
        </div>

        <!-- Recent Sales -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">المبيعات اليوم</h3>
                
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($recentSales as $sale)
                        <div class="flex justify-between items-center py-3 border-b">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $sale->marketer->name ?? 'مسوق' }}</p>
                                <p class="text-xs text-gray-500">{{ $sale->store->name ?? 'متجر' }}</p>
                                <p class="text-xs text-gray-500">{{ $sale->product->name ?? 'منتج' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $sale->quantity }} × {{ number_format($sale->price_at_sale, 2) }}</p>
                                <p class="text-sm font-semibold text-indigo-600">{{ number_format($sale->total, 2) }} د.ل</p>
                                <p class="text-xs text-gray-500">
                                    @if($sale->invoice_sent)
                                        <span class="text-green-600">✓ فاتورة مرسلة</span>
                                    @else
                                        <span class="text-yellow-600">⏳ فاتورة غير مرسلة</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">لا توجد مبيعات اليوم</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


