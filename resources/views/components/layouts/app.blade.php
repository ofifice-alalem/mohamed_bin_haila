<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h1 class="text-xl font-bold text-gray-900">نظام إدارة المخزون</h1>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                لوحة التحكم
                            </x-nav-link>
                            <x-nav-link href="{{ route('marketers.list') }}" :active="request()->routeIs('marketers.*')">
                                المسوقين
                            </x-nav-link>
                            <x-nav-link href="{{ route('stock.issue') }}" :active="request()->routeIs('stock.*')">
                                إعطاء بضاعة
                            </x-nav-link>
                            <x-nav-link href="{{ route('sales.record') }}" :active="request()->routeIs('sales.*')">
                                تسجيل مبيع
                            </x-nav-link>
                            <x-nav-link href="{{ route('returns.marketers') }}" :active="request()->routeIs('returns.*')">
                                الإرجاعات
                            </x-nav-link>
                            <x-nav-link href="{{ route('invoices.stores') }}" :active="request()->routeIs('invoices.*')">
                                الفواتير
                            </x-nav-link>
                            <x-nav-link href="{{ route('reports.daily') }}" :active="request()->routeIs('reports.*')">
                                التقارير
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('message') }}
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>

