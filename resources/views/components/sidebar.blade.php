<div x-data="{ open: false }" class="flex h-screen bg-gray-100">
    <!-- Sidebar للشاشات الكبيرة -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto bg-gradient-to-b from-blue-800 to-blue-900">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 px-4 mb-8">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="mr-3 text-xl font-bold text-white">نظام المخزون</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>الرئيسية</span>
                    </a>

                    <!-- المنتجات -->
                    <a href="{{ route('products.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>المنتجات</span>
                    </a>

                    <!-- المسوقين -->
                    <a href="{{ route('marketers.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('marketers.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>المسوقين</span>
                    </a>

                    <!-- إعطاء بضاعة -->
                    <a href="{{ route('stock.issue') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('stock.issue') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span>إعطاء بضاعة</span>
                    </a>

                    <!-- المبيعات -->
                    <a href="{{ route('sales.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('sales.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>المبيعات</span>
                    </a>

                    <!-- المرتجعات -->
                    <a href="{{ route('returns.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('returns.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                        </svg>
                        <span>المرتجعات</span>
                    </a>

                    <!-- الفواتير -->
                    <a href="{{ route('invoices.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('invoices.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>الفواتير</span>
                    </a>

                    <!-- التقارير -->
                    <a href="{{ route('reports.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>التقارير</span>
                    </a>
                </nav>

                <!-- User Profile -->
                <div class="flex-shrink-0 flex border-t border-blue-700 p-4">
                    <div class="flex items-center w-full">
                        <div>
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" 
                                 src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=3B82F6&color=fff" 
                                 alt="User avatar">
                        </div>
                        <div class="mr-3 flex-1">
                            <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'المستخدم' }}</p>
                            <p class="text-xs text-blue-200">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-blue-200 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu button -->
    <div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
        <div class="flex items-center justify-between p-4">
            <button @click="open = !open" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-lg font-bold text-gray-800">نظام المخزون</span>
            <div class="w-6"></div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform -translate-x-full"
         class="md:hidden fixed inset-0 z-40 flex">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="open = false"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gradient-to-b from-blue-800 to-blue-900">
            <div class="absolute top-0 left-0 -ml-12 pt-2">
                <button @click="open = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 px-4 mb-8">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="mr-3 text-xl font-bold text-white">نظام المخزون</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>الرئيسية</span>
                    </a>

                    <!-- المنتجات -->
                    <a href="{{ route('products.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>المنتجات</span>
                    </a>

                    <!-- المسوقين -->
                    <a href="{{ route('marketers.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('marketers.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>المسوقين</span>
                    </a>

                    <!-- إعطاء بضاعة -->
                    <a href="{{ route('stock.issue') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('stock.issue') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span>إعطاء بضاعة</span>
                    </a>

                    <!-- المبيعات -->
                    <a href="{{ route('sales.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('sales.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>المبيعات</span>
                    </a>

                    <!-- المرتجعات -->
                    <a href="{{ route('returns.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('returns.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                        </svg>
                        <span>المرتجعات</span>
                    </a>

                    <!-- الفواتير -->
                    <a href="{{ route('invoices.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('invoices.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>الفواتير</span>
                    </a>

                    <!-- التقارير -->
                    <a href="{{ route('reports.index') }}" 
                       class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>التقارير</span>
                    </a>
                </nav>

                <!-- User Profile -->
                <div class="flex-shrink-0 flex border-t border-blue-700 p-4">
                    <div class="flex items-center w-full">
                        <div>
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" 
                                 src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=3B82F6&color=fff" 
                                 alt="User avatar">
                        </div>
                        <div class="mr-3 flex-1">
                            <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'المستخدم' }}</p>
                            <p class="text-xs text-blue-200">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-blue-200 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
            <!-- Page content goes here -->
            @yield('content')
        </main>
    </div>
</div>