<div>
    <!-- Success Dialog -->
    @if($showSuccessDialog)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
             wire:click="closeDialog">
            <div class="relative w-full max-w-md p-6 mx-auto bg-white rounded-lg shadow-xl" 
                 @click.away="$wire.closeDialog()">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="mt-5 text-2xl font-semibold text-gray-800">تم بنجاح!</h3>
                    <div class="mt-3">
                        <p class="text-base text-gray-600">
                            تم إعطاء البضاعة للمسوق بنجاح.
                        </p>
                    </div>
                    <div class="mt-6">
                        <button wire:click="closeDialog"
                                class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            موافق
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    @this.call('closeDialog');
                }
            });
        </script>
    @endif

    <div class="bg-gray-50 p-4 sm:p-6 lg:p-8 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <header class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">إدارة مخزون المسوقين</h1>
                <p class="mt-1 text-lg text-gray-600">إعطاء بضاعة جديدة أو عرض المخزون الحالي.</p>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Issue Stock Form -->
                <div class="lg:col-span-2 bg-white shadow-lg rounded-xl border border-gray-200">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">إعطاء بضاعة لمسوق</h3>
                        
                        <form wire:submit="issueStock" class="space-y-6">
                            <div>
                                <label for="marketerId" class="block text-sm font-medium text-gray-700 mb-1">المسوق</label>
                                <select id="marketerId" wire:model.live="marketerId" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base py-2.5">
                                    <option value="">اختر المسوق</option>
                                    @foreach($marketers as $marketer)
                                        <option value="{{ $marketer->id }}">{{ $marketer->name }}</option>
                                    @endforeach
                                </select>
                                @error('marketerId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="productId" class="block text-sm font-medium text-gray-700 mb-1">المنتج</label>
                                <select id="productId" wire:model.live="productId" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base py-2.5">
                                    <option value="">اختر المنتج</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('productId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">الكمية</label>
                                <input id="quantity" type="number" wire:model.live="quantity" placeholder="أدخل الكمية" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base py-2.5">
                                @error('quantity') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-4">
                                <button type="submit" 
                                        wire:loading.attr="disabled"
                                        class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:bg-blue-300 transition-colors duration-200">
                                    <span wire:loading.remove>إعطاء البضاعة</span>
                                    <span wire:loading>جاري الحفظ...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Placeholder for other content, e.g., current stock view -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6 sm:p-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">المخزون الحالي</h3>
                    <div class="text-center text-gray-500 py-12">
                        <p>سيتم عرض تفاصيل المخزون هنا.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
        <!-- Recent Stock Movements -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">حركات المخزون اليوم</h3>
                
                <div class="space-y-6 max-h-96 overflow-y-auto">
                    @forelse($movementsByMarketer as $marketerData)
                        <div class="border rounded-lg p-4">
                            <!-- رأس الجدول - معلومات المسوق -->
                            <div class="flex justify-between items-center mb-3 pb-2 border-b">
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">{{ $marketerData['marketer']->name ?? 'مسوق' }}</h4>
                                    <p class="text-xs text-gray-500">{{ $marketerData['marketer']->phone ?? '' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-700">إجمالي المأخوذ: {{ $marketerData['total_quantity_taken'] }}</p>
                                    <p class="text-xs text-gray-500">إجمالي المتبقي: {{ $marketerData['total_quantity_remaining'] }}</p>
                                </div>
                            </div>

                            <!-- جدول المنتجات -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المنتج</th>
                                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الوحدة</th>
                                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المأخوذ</th>
                                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المباع</th>
                                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المتبقي</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($marketerData['movements'] as $movement)
                                            <tr>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $movement->product->name ?? 'منتج' }}
                                                </td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $movement->product->unit ?? '-' }}
                                                </td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $movement->quantity_taken }}
                                                </td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $movement->quantity_sold }}
                                                </td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium {{ $movement->quantity_remaining > 0 ? 'text-green-600' : 'text-gray-500' }}">
                                                    {{ $movement->quantity_remaining }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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