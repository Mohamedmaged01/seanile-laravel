@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'جميع الرحلات – سي نايل' : 'All Trips – SeaNile Tourism')
@section('meta_description', 'Browse all Red Sea trips – diving, safari, beach, cruise, fishing and more. Filter by destination, price or rating.')

@section('content')

{{-- Page Header --}}
<section class="py-14 px-4 bg-gradient-to-br from-blue-900 to-blue-700 text-white text-center">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-3">
            {{ app()->getLocale() === 'ar' ? 'جميع الرحلات' : 'All Trips' }}
        </h1>
        <p class="text-blue-200 text-base">
            {{ app()->getLocale() === 'ar'
                ? 'اعثر على رحلتك المثالية في البحر الأحمر'
                : 'Find your perfect Red Sea adventure' }}
        </p>
    </div>
</section>

{{-- Search & Filter Bar --}}
<section class="sticky top-16 lg:top-20 z-30 bg-white border-b border-gray-200 shadow-sm py-4 px-4">
    <div class="max-w-7xl mx-auto">
        <form method="GET" action="/trips" class="flex flex-wrap gap-3 items-end">

            {{-- Search --}}
            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    {{ app()->getLocale() === 'ar' ? 'بحث' : 'Search' }}
                </label>
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'ابحث عن رحلة...' : 'Search trips...' }}"
                           class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Category --}}
            <div class="min-w-[140px]">
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    {{ app()->getLocale() === 'ar' ? 'الفئة' : 'Category' }}
                </label>
                <select name="category"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                    <option value="">{{ app()->getLocale() === 'ar' ? 'جميع الفئات' : 'All Categories' }}</option>
                    @foreach([
                        ['diving', app()->getLocale() === 'ar' ? 'غوص' : 'Diving'],
                        ['safari', app()->getLocale() === 'ar' ? 'سفاري' : 'Safari'],
                        ['beach', app()->getLocale() === 'ar' ? 'شاطئ' : 'Beach'],
                        ['cruise', app()->getLocale() === 'ar' ? 'كروز' : 'Cruise'],
                        ['fishing', app()->getLocale() === 'ar' ? 'صيد' : 'Fishing'],
                        ['watersports', app()->getLocale() === 'ar' ? 'رياضات مائية' : 'Water Sports'],
                    ] as [$val, $label])
                        <option value="{{ $val }}" {{ request('category') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Destination --}}
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    {{ app()->getLocale() === 'ar' ? 'الوجهة' : 'Destination' }}
                </label>
                <select name="destination"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                    <option value="">{{ app()->getLocale() === 'ar' ? 'جميع الوجهات' : 'All Destinations' }}</option>
                    @if(isset($destinations))
                        @foreach($destinations as $dest)
                            <option value="{{ is_array($dest) ? $dest['name'] : $dest }}"
                                    {{ request('destination') === (is_array($dest) ? $dest['name'] : $dest) ? 'selected' : '' }}>
                                {{ is_array($dest) ? $dest['name'] : $dest }}
                            </option>
                        @endforeach
                    @else
                        @foreach(['Hurghada', 'Sharm El-Sheikh', 'Marsa Alam', 'Dahab', 'El Gouna', 'Safaga'] as $dest)
                            <option value="{{ $dest }}" {{ request('destination') === $dest ? 'selected' : '' }}>{{ $dest }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- Sort --}}
            <div class="min-w-[150px]">
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    {{ app()->getLocale() === 'ar' ? 'ترتيب حسب' : 'Sort By' }}
                </label>
                <select name="sort"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                    @foreach([
                        ['recommended', app()->getLocale() === 'ar' ? 'الأكثر شيوعاً' : 'Recommended'],
                        ['price_asc', app()->getLocale() === 'ar' ? 'السعر: من الأقل' : 'Price: Low to High'],
                        ['price_desc', app()->getLocale() === 'ar' ? 'السعر: من الأعلى' : 'Price: High to Low'],
                        ['rating', app()->getLocale() === 'ar' ? 'الأعلى تقييماً' : 'Highest Rated'],
                    ] as [$val, $label])
                        <option value="{{ $val }}" {{ request('sort', 'recommended') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Submit --}}
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1 opacity-0">.</label>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    {{ app()->getLocale() === 'ar' ? 'فلترة' : 'Filter' }}
                </button>
            </div>

            {{-- Clear filters --}}
            @if(request()->hasAny(['search', 'category', 'destination', 'sort']))
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1 opacity-0">.</label>
                    <a href="/trips"
                       class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-800 border border-gray-300 hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ app()->getLocale() === 'ar' ? 'مسح' : 'Clear' }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</section>

{{-- Trips Grid --}}
<section class="py-12 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">

        {{-- Results info --}}
        @if(isset($trips))
            <div class="flex items-center justify-between mb-8">
                <p class="text-gray-600 text-sm">
                    @if($trips instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ app()->getLocale() === 'ar'
                            ? "عرض {$trips->firstItem()}-{$trips->lastItem()} من {$trips->total()} رحلة"
                            : "Showing {$trips->firstItem()}-{$trips->lastItem()} of {$trips->total()} trips" }}
                    @else
                        {{ app()->getLocale() === 'ar' ? count($trips) . ' رحلة' : count($trips) . ' trips' }}
                    @endif
                </p>
            </div>
        @endif

        @if(isset($trips) && count($trips))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($trips as $trip)
                    <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <div class="relative h-48 overflow-hidden">
                            @if($trip->image)
                                <img src="{{ asset($trip->image) }}"
                                     alt="{{ $trip->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center">
                                    <span class="text-5xl">
                                        @switch($trip->category)
                                            @case('diving') 🤿 @break
                                            @case('safari') 🐠 @break
                                            @case('cruise') 🚢 @break
                                            @case('fishing') 🎣 @break
                                            @default 🏖️
                                        @endswitch
                                    </span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            @if($trip->category)
                                <span class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">
                                    {{ $trip->category }}
                                </span>
                            @endif
                            @if($trip->rating)
                                <span class="absolute top-3 right-3 bg-white/90 text-gray-800 text-xs font-semibold px-2 py-0.5 rounded-full flex items-center gap-0.5">
                                    <span class="text-yellow-500">★</span> {{ number_format($trip->rating, 1) }}
                                </span>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 text-base leading-snug mb-1 line-clamp-2">
                                {{ app()->getLocale() === 'ar' && isset($trip->title_ar) ? $trip->title_ar : $trip->title }}
                            </h3>
                            @if($trip->destination)
                                <p class="text-xs text-gray-500 flex items-center gap-1 mb-3">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $trip->destination }}
                                </p>
                            @endif

                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <span class="text-xl font-extrabold text-blue-700">${{ number_format($trip->price, 0) }}</span>
                                    <span class="text-gray-400 text-xs">/{{ app()->getLocale() === 'ar' ? 'شخص' : 'person' }}</span>
                                </div>
                                @if($trip->duration)
                                    <span class="text-xs text-gray-500">⏱ {{ $trip->duration }}</span>
                                @endif
                            </div>

                            <a href="/trips/{{ $trip->id }}"
                               class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2.5 rounded-xl font-semibold text-xs text-center transition">
                                {{ app()->getLocale() === 'ar' ? 'عرض التفاصيل' : 'View Details' }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($trips instanceof \Illuminate\Pagination\LengthAwarePaginator && $trips->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $trips->appends(request()->query())->links() }}
                </div>
            @endif

        @else
            <div class="text-center py-24">
                <span class="text-6xl block mb-5">🔍</span>
                <h3 class="text-xl font-bold text-gray-700 mb-2">
                    {{ app()->getLocale() === 'ar' ? 'لا توجد رحلات' : 'No trips found' }}
                </h3>
                <p class="text-gray-500 text-sm mb-6">
                    {{ app()->getLocale() === 'ar' ? 'جرب تغيير معايير البحث' : 'Try adjusting your search criteria' }}
                </p>
                <a href="/trips" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition text-sm">
                    {{ app()->getLocale() === 'ar' ? 'عرض جميع الرحلات' : 'View All Trips' }}
                </a>
            </div>
        @endif
    </div>
</section>

@endsection
