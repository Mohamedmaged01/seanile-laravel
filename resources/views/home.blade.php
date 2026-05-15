@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'سي نايل – اكتشف جنة البحر الأحمر' : 'SeaNile – Discover Egypt\'s Red Sea Paradise')
@section('meta_description', 'Book diving, sailing and adventure trips in the Red Sea, Egypt. Best prices, expert guides, unforgettable memories.')

@section('content')

{{-- ========== HERO SECTION ========== --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Background Image --}}
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('/images/hero.jpg')"></div>
    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-950/90 via-blue-900/75 to-cyan-900/60"></div>

    {{-- Hero Content --}}
    <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-5 py-2 text-sm font-medium mb-8">
            <span>🌊</span>
            <span>{{ app()->getLocale() === 'ar' ? 'أفضل تجارب البحر الأحمر' : 'Best Red Sea Experiences' }}</span>
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
            @if(app()->getLocale() === 'ar')
                اكتشف جنة <span class="text-cyan-300">البحر الأحمر</span> في مصر
            @else
                Discover Egypt's <span class="text-cyan-300">Red Sea</span> Paradise
            @endif
        </h1>

        <p class="text-lg sm:text-xl text-white/85 max-w-2xl mx-auto mb-10 leading-relaxed">
            {{ app()->getLocale() === 'ar'
                ? 'تجارب غوص وإبحار ومغامرات لا تُنسى في قلب البحر الأحمر'
                : 'Unforgettable diving, sailing, and adventure experiences in the heart of the Red Sea' }}
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
            <a href="/trips"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold text-base transition shadow-lg hover:shadow-xl w-full sm:w-auto">
                {{ app()->getLocale() === 'ar' ? 'استكشف الرحلات' : 'Explore Trips' }}
            </a>
            <a href="/trips"
               class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-semibold text-base transition shadow-lg hover:shadow-xl w-full sm:w-auto">
                {{ app()->getLocale() === 'ar' ? 'احجز الآن' : 'Book Now' }}
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 sm:gap-12">
            @foreach([
                ['2,000+', app()->getLocale() === 'ar' ? 'مسافر سعيد' : 'Happy Travelers'],
                ['48', app()->getLocale() === 'ar' ? 'رحلة نشطة' : 'Active Trips'],
                ['5★', app()->getLocale() === 'ar' ? 'خدمة مُقيَّمة' : 'Rated Service'],
            ] as [$num, $label])
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-cyan-300">{{ $num }}</div>
                    <div class="text-sm text-white/70 mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/60 animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ========== SEARCH SECTION ========== --}}
<section class="py-8 px-4 bg-gray-50">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-5">
                {{ app()->getLocale() === 'ar' ? '🔍 ابحث عن رحلتك المثالية' : '🔍 Find Your Perfect Trip' }}
            </h2>
            <form action="/trips" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="lg:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? '📍 الوجهة' : '📍 Destination' }}
                        </label>
                        <select name="destination"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'جميع الوجهات' : 'All Destinations' }}</option>
                            @foreach(['Hurghada', 'Sharm El-Sheikh', 'Marsa Alam', 'Dahab', 'El Gouna', 'Safaga'] as $dest)
                                <option value="{{ $dest }}">{{ $dest }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? '🏄 نوع الرحلة' : '🏄 Trip Type' }}
                        </label>
                        <select name="category"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'جميع الأنواع' : 'All Types' }}</option>
                            @foreach(['diving' => '🤿', 'safari' => '🏜️', 'beach' => '🏖️', 'cruise' => '🚢', 'fishing' => '🎣', 'watersports' => '🏄'] as $cat => $emoji)
                                <option value="{{ $cat }}">{{ $emoji }} {{ ucfirst($cat) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? '👥 عدد الأشخاص' : '👥 Adults' }}
                        </label>
                        <select name="adults"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                            @foreach(range(1, 10) as $n)
                                <option value="{{ $n }}">{{ $n }} {{ app()->getLocale() === 'ar' ? 'شخص' : ($n === 1 ? 'Adult' : 'Adults') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white py-3 px-6 rounded-xl font-semibold text-sm transition shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            {{ app()->getLocale() === 'ar' ? 'بحث' : 'Search' }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex flex-wrap items-center gap-2 mt-5 pt-4 border-t border-gray-100">
                <span class="text-xs font-semibold text-gray-400">
                    {{ app()->getLocale() === 'ar' ? 'تصفح سريع:' : 'Quick filters:' }}
                </span>
                @foreach([
                    ['diving',      '🤿', app()->getLocale() === 'ar' ? 'غوص'          : 'Diving'],
                    ['beach',       '🏖️', app()->getLocale() === 'ar' ? 'شاطئ'         : 'Beach'],
                    ['safari',      '🏜️', app()->getLocale() === 'ar' ? 'سفاري'        : 'Safari'],
                    ['cruise',      '🚢', app()->getLocale() === 'ar' ? 'رحلة بحرية'   : 'Cruise'],
                    ['fishing',     '🎣', app()->getLocale() === 'ar' ? 'صيد'          : 'Fishing'],
                    ['watersports', '🏄', app()->getLocale() === 'ar' ? 'رياضات مائية' : 'Water Sports'],
                ] as [$cat, $emoji, $label])
                    <a href="/trips?category={{ $cat }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-full transition">
                        <span>{{ $emoji }}</span>
                        <span>{{ $label }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ========== FEATURED TRIPS SECTION ========== --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <div>
                <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">
                    {{ app()->getLocale() === 'ar' ? 'رحلاتنا المميزة' : 'Our Top Picks' }}
                </p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                    {{ app()->getLocale() === 'ar' ? 'الرحلات المميزة' : 'Featured Trips' }}
                </h2>
            </div>
            <a href="/trips"
               class="hidden sm:inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm transition">
                {{ app()->getLocale() === 'ar' ? 'عرض الكل' : 'View All' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ app()->getLocale() === 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}"/>
                </svg>
            </a>
        </div>

        @if(isset($featuredTrips) && $featuredTrips->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredTrips as $trip)
                    <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        {{-- Trip Image / Gradient --}}
                        <div class="relative h-52 overflow-hidden">
                            @if($trip->image)
                                <img src="{{ asset($trip->image) }}"
                                     alt="{{ $trip->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center">
                                    <span class="text-6xl">🤿</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            {{-- Badge --}}
                            @if($trip->category)
                                <span class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                    {{ $trip->category }}
                                </span>
                            @endif
                            {{-- Rating --}}
                            @if($trip->rating)
                                <span class="absolute top-3 right-3 bg-white/90 text-gray-800 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                                    <span class="text-yellow-500">★</span> {{ number_format($trip->rating, 1) }}
                                </span>
                            @endif
                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 text-lg leading-snug mb-1 line-clamp-2">
                                {{ app()->getLocale() === 'ar' && $trip->title_ar ? $trip->title_ar : $trip->title }}
                            </h3>
                            @if($trip->destination)
                                <p class="text-sm text-gray-500 flex items-center gap-1 mb-3">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ app()->getLocale() === 'ar' && $trip->destination->name_ar ? $trip->destination->name_ar : $trip->destination->name }}
                                </p>
                            @endif

                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-2xl font-extrabold text-blue-700">${{ number_format($trip->price, 0) }}</span>
                                    <span class="text-gray-500 text-sm"> / {{ app()->getLocale() === 'ar' ? 'شخص' : 'person' }}</span>
                                </div>
                                @if($trip->duration)
                                    <span class="text-sm text-gray-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $trip->duration }}
                                    </span>
                                @endif
                            </div>

                            <a href="/trips/{{ $trip->id }}"
                               class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm text-center transition">
                                {{ app()->getLocale() === 'ar' ? 'احجز الآن' : 'Book Now' }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-gray-500">
                <span class="text-5xl block mb-4">🌊</span>
                <p>{{ app()->getLocale() === 'ar' ? 'لا توجد رحلات متاحة حالياً' : 'No trips available at the moment.' }}</p>
            </div>
        @endif

        <div class="text-center mt-10 sm:hidden">
            <a href="/trips" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                {{ app()->getLocale() === 'ar' ? 'عرض جميع الرحلات' : 'View All Trips' }}
            </a>
        </div>
    </div>
</section>

{{-- ========== SPECIAL OFFERS SECTION ========== --}}
<section class="py-20 px-4 bg-gradient-to-br from-blue-950 via-blue-900 to-cyan-900">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 bg-yellow-400/10 border border-yellow-400/30 text-yellow-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-4">
                🔥 {{ app()->getLocale() === 'ar' ? 'عروض حصرية' : 'Exclusive Deals' }}
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">
                {{ app()->getLocale() === 'ar' ? 'عروض سفر محدودة الوقت' : 'Limited-Time Travel Deals' }}
            </h2>
            <p class="text-blue-200 text-base max-w-xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'احجز الآن واستمتع بخصومات حصرية على أفضل رحلاتنا'
                    : 'Book now and enjoy exclusive savings on our best trips' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Offer 1 --}}
            <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 hover:border-white/20 transition-all duration-300 hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center overflow-hidden">
                    <span class="text-7xl group-hover:scale-110 transition-transform duration-500">🤿</span>
                    <span class="absolute top-3 start-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ app()->getLocale() === 'ar' ? 'الأكثر شعبية' : 'Most Popular' }}
                    </span>
                    <div class="absolute top-3 end-3 w-14 h-14 bg-yellow-400 rounded-full flex flex-col items-center justify-center shadow-lg">
                        <span class="text-blue-900 font-extrabold text-lg leading-none">30%</span>
                        <span class="text-blue-900 text-xs font-bold leading-none">OFF</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-white font-bold text-lg mb-1">
                        {{ app()->getLocale() === 'ar' ? 'باقة الغوص في البحر الأحمر' : 'Red Sea Diving Package' }}
                    </h3>
                    <p class="text-blue-200 text-sm mb-4">
                        {{ app()->getLocale() === 'ar' ? 'يوم كامل من الغوص مع مرشد خبير ومعدات احترافية' : 'Full day diving with expert guide and professional equipment' }}
                    </p>
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach([app()->getLocale() === 'ar' ? '🏖️ شاطئ' : '🏖️ Beach', app()->getLocale() === 'ar' ? '🤿 غوص' : '🤿 Diving', app()->getLocale() === 'ar' ? '🍽️ وجبة' : '🍽️ Meal'] as $pill)
                            <span class="text-xs bg-white/10 text-blue-200 px-2.5 py-1 rounded-full">{{ $pill }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-white/40 text-sm line-through">$150</span>
                            <span class="text-yellow-300 font-extrabold text-xl ms-2">$105</span>
                        </div>
                        <a href="/trips?category=diving"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-1">
                            {{ app()->getLocale() === 'ar' ? 'احجز' : 'Book' }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ app()->getLocale() === 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Offer 2 --}}
            <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 hover:border-white/20 transition-all duration-300 hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center overflow-hidden">
                    <span class="text-7xl group-hover:scale-110 transition-transform duration-500">🏜️</span>
                    <span class="absolute top-3 start-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ app()->getLocale() === 'ar' ? 'قيمة استثنائية' : 'Best Value' }}
                    </span>
                    <div class="absolute top-3 end-3 w-14 h-14 bg-yellow-400 rounded-full flex flex-col items-center justify-center shadow-lg">
                        <span class="text-blue-900 font-extrabold text-base leading-none">3+1</span>
                        <span class="text-blue-900 text-xs font-bold leading-none">FREE</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-white font-bold text-lg mb-1">
                        {{ app()->getLocale() === 'ar' ? 'سفاري الصحراء والبحر' : 'Desert & Sea Safari' }}
                    </h3>
                    <p class="text-blue-200 text-sm mb-4">
                        {{ app()->getLocale() === 'ar' ? 'احجز 3 رحلات واحصل على الرابعة مجاناً' : 'Book 3 trips and get the 4th completely free' }}
                    </p>
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach([app()->getLocale() === 'ar' ? '🐪 جمال' : '🐪 Camels', app()->getLocale() === 'ar' ? '🌅 غروب' : '🌅 Sunset', app()->getLocale() === 'ar' ? '☕ شاي' : '☕ Bedouin Tea'] as $pill)
                            <span class="text-xs bg-white/10 text-blue-200 px-2.5 py-1 rounded-full">{{ $pill }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-yellow-300 font-extrabold text-xl">$80</span>
                            <span class="text-white/50 text-xs ms-1">/ {{ app()->getLocale() === 'ar' ? 'شخص' : 'person' }}</span>
                        </div>
                        <a href="/trips?category=safari"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-1">
                            {{ app()->getLocale() === 'ar' ? 'احجز' : 'Book' }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ app()->getLocale() === 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Offer 3 --}}
            <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 hover:border-white/20 transition-all duration-300 hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-purple-600 to-blue-700 flex items-center justify-center overflow-hidden">
                    <span class="text-7xl group-hover:scale-110 transition-transform duration-500">🚢</span>
                    <span class="absolute top-3 start-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ app()->getLocale() === 'ar' ? 'وقت محدود' : 'Limited Time' }}
                    </span>
                    <div class="absolute top-3 end-3 w-14 h-14 bg-yellow-400 rounded-full flex flex-col items-center justify-center shadow-lg">
                        <span class="text-blue-900 font-extrabold text-lg leading-none">25%</span>
                        <span class="text-blue-900 text-xs font-bold leading-none">OFF</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-white font-bold text-lg mb-1">
                        {{ app()->getLocale() === 'ar' ? 'رحلة بحرية فاخرة' : 'Luxury Cruise Experience' }}
                    </h3>
                    <p class="text-blue-200 text-sm mb-4">
                        {{ app()->getLocale() === 'ar' ? 'يخت خاص مع وجبات فاخرة وغطس في أجمل المواقع' : 'Private yacht with gourmet meals and snorkeling at top spots' }}
                    </p>
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach([app()->getLocale() === 'ar' ? '🥂 شامل الكل' : '🥂 All Inclusive', app()->getLocale() === 'ar' ? '🎵 موسيقى' : '🎵 Music', app()->getLocale() === 'ar' ? '📸 تصوير' : '📸 Photography'] as $pill)
                            <span class="text-xs bg-white/10 text-blue-200 px-2.5 py-1 rounded-full">{{ $pill }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-white/40 text-sm line-through">$200</span>
                            <span class="text-yellow-300 font-extrabold text-xl ms-2">$150</span>
                        </div>
                        <a href="/trips?category=cruise"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-1">
                            {{ app()->getLocale() === 'ar' ? 'احجز' : 'Book' }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ app()->getLocale() === 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-10">
            <a href="/trips"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-8 py-3 rounded-xl font-semibold text-sm transition">
                {{ app()->getLocale() === 'ar' ? 'عرض جميع العروض' : 'View All Deals' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ app()->getLocale() === 'ar' ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7' }}"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ========== DESTINATIONS SECTION ========== --}}
<section id="destinations" class="py-20 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">
                {{ app()->getLocale() === 'ar' ? 'اكتشف وجهاتنا' : 'Explore Our Destinations' }}
            </p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'الوجهات الشعبية' : 'Popular Destinations' }}
            </h2>
        </div>

        @if(isset($destinations) && count($destinations))
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($destinations as $destination)
                    <div class="relative h-48 sm:h-64 rounded-2xl overflow-hidden group cursor-pointer">
                        @if(isset($destination['image']))
                            <img src="{{ asset($destination['image']) }}"
                                 alt="{{ $destination['name'] ?? '' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-cyan-500 to-blue-600"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-bold text-base sm:text-lg">
                                {{ $destination['name'] ?? '' }}
                            </h3>
                            @if(isset($destination['trips_count']))
                                <p class="text-white/75 text-xs sm:text-sm mt-0.5">
                                    {{ $destination['trips_count'] }} {{ app()->getLocale() === 'ar' ? 'رحلة' : 'trips' }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach(['Hurghada', 'Sharm El-Sheikh', 'Marsa Alam', 'Dahab', 'El Gouna', 'Safaga'] as $dest)
                    <div class="relative h-48 sm:h-64 rounded-2xl overflow-hidden group">
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                            <span class="text-5xl">🏖️</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-bold text-base sm:text-lg">{{ $dest }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ========== HOW IT WORKS SECTION ========== --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-14">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">
                {{ app()->getLocale() === 'ar' ? 'الخطوات' : 'Simple Steps' }}
            </p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'كيف يعمل' : 'How It Works' }}
            </h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach([
                ['🔍', '1', app()->getLocale() === 'ar' ? 'ابحث' : 'Search', app()->getLocale() === 'ar' ? 'تصفح مئات الرحلات والوجهات' : 'Browse hundreds of trips and destinations'],
                ['🎯', '2', app()->getLocale() === 'ar' ? 'اختر' : 'Select', app()->getLocale() === 'ar' ? 'اختر الرحلة المثالية لك' : 'Pick the perfect trip for you'],
                ['📅', '3', app()->getLocale() === 'ar' ? 'احجز' : 'Book', app()->getLocale() === 'ar' ? 'أكمل حجزك بأمان وسهولة' : 'Complete your booking securely'],
                ['🎉', '4', app()->getLocale() === 'ar' ? 'استمتع' : 'Enjoy', app()->getLocale() === 'ar' ? 'استمتع بتجربة لا تُنسى' : 'Enjoy an unforgettable experience'],
            ] as [$icon, $num, $title, $desc])
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl relative">
                        {{ $icon }}
                        <span class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            {{ $num }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-2">{{ $title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== FEATURES / SERVICES SECTION ========== --}}
<section class="py-20 px-4 bg-gradient-to-br from-blue-600 to-cyan-600">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">
                {{ app()->getLocale() === 'ar' ? 'لماذا تختار سي نايل؟' : 'Why Choose SeaNile?' }}
            </h2>
            <p class="text-white/80 text-base max-w-xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'نقدم أفضل تجارب البحر الأحمر بمعايير عالمية وأسعار تنافسية'
                    : 'We deliver world-class Red Sea experiences at competitive prices' }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['🧑‍✈️', app()->getLocale() === 'ar' ? 'مرشدون خبراء' : 'Expert Guides', app()->getLocale() === 'ar' ? 'مرشدون معتمدون بخبرة 10+ سنوات' : 'Certified guides with 10+ years experience'],
                ['🛡️', app()->getLocale() === 'ar' ? 'معدات آمنة' : 'Safe Equipment', app()->getLocale() === 'ar' ? 'معدات غوص معتمدة وصيانة دورية' : 'Certified diving gear with regular maintenance'],
                ['📋', app()->getLocale() === 'ar' ? 'حجز مرن' : 'Flexible Booking', app()->getLocale() === 'ar' ? 'إلغاء مجاني حتى 48 ساعة' : 'Free cancellation up to 48 hours before'],
                ['💰', app()->getLocale() === 'ar' ? 'أفضل الأسعار' : 'Best Prices', app()->getLocale() === 'ar' ? 'ضمان أفضل سعر مع قيمة لا تضاهى' : 'Best price guarantee with unmatched value'],
                ['📞', app()->getLocale() === 'ar' ? 'دعم 24/7' : '24/7 Support', app()->getLocale() === 'ar' ? 'فريق دعم على مدار الساعة' : 'Round-the-clock customer support team'],
                ['👥', app()->getLocale() === 'ar' ? 'خصومات جماعية' : 'Group Discounts', app()->getLocale() === 'ar' ? 'خصومات حصرية للمجموعات والعائلات' : 'Exclusive discounts for groups and families'],
            ] as [$icon, $title, $desc])
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300">
                    <div class="text-3xl mb-4">{{ $icon }}</div>
                    <h3 class="font-bold text-white text-lg mb-2">{{ $title }}</h3>
                    <p class="text-white/75 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== PARTNERS SECTION ========== --}}
<section class="py-16 px-4 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <p class="text-gray-400 text-xs font-semibold uppercase tracking-widest mb-2">
                {{ app()->getLocale() === 'ar' ? 'شركاؤنا' : 'Our Partners' }}
            </p>
            <h2 class="text-2xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'نعمل مع أفضل الشركاء' : 'Partnering with the Best' }}
            </h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['🏨', app()->getLocale() === 'ar' ? 'فنادق'          : 'Hotels'],
                ['🤿', app()->getLocale() === 'ar' ? 'مراكز غوص'      : 'Dive Centers'],
                ['🏜️', app()->getLocale() === 'ar' ? 'جولات صحراوية'  : 'Desert Tours'],
                ['⛵', app()->getLocale() === 'ar' ? 'نوادي الإبحار'  : 'Sailing Clubs'],
                ['🍽️', app()->getLocale() === 'ar' ? 'مطاعم'          : 'Restaurants'],
                ['🎭', app()->getLocale() === 'ar' ? 'ترفيه'          : 'Entertainment'],
            ] as [$emoji, $label])
                <div class="group flex flex-col items-center gap-3 p-5 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 rounded-2xl transition-all duration-300 hover:-translate-y-0.5 cursor-default">
                    <span class="text-4xl group-hover:scale-110 transition-transform duration-300">{{ $emoji }}</span>
                    <span class="text-sm font-semibold text-gray-600 group-hover:text-blue-700 text-center transition">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== TESTIMONIALS SECTION ========== --}}
<section class="py-20 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">
                {{ app()->getLocale() === 'ar' ? 'آراء عملائنا' : 'Client Reviews' }}
            </p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'ماذا يقول عملاؤنا' : 'What Our Clients Say' }}
            </h2>
        </div>

        @if(isset($testimonials) && count($testimonials))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= ($testimonial->rating ?? 5) ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">
                            "{{ $testimonial->comment ?? $testimonial->content ?? '' }}"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $testimonial->name ?? '' }}</p>
                                <p class="text-xs text-gray-500">{{ $testimonial->country ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Placeholder testimonials --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['Sarah M.', 'USA', 'Absolutely incredible experience! The diving was world-class and the guides were so professional. Will definitely come back!'],
                    ['Ahmed K.', 'Egypt', 'أفضل تجربة غوص في حياتي. الفريق محترف جداً والمعدات ممتازة. أنصح به بشدة!'],
                    ['Marco R.', 'Italy', 'SeaNile made our family vacation perfect. The kids loved the snorkeling and we saw amazing marine life.'],
                ] as [$name, $country, $comment])
                    <div class="bg-white rounded-2xl shadow-md p-6">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">"{{ $comment }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $name }}</p>
                                <p class="text-xs text-gray-500">{{ $country }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ========== FAQ SECTION ========== --}}
<section class="py-20 px-4 bg-white" id="about">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">FAQ</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'الأسئلة الشائعة' : 'Frequently Asked Questions' }}
            </h2>
        </div>

        <div x-data="{ open: null }" class="space-y-3">
            @foreach([
                [
                    app()->getLocale() === 'ar' ? 'هل أحتاج خبرة في الغوص؟' : 'Do I need diving experience?',
                    app()->getLocale() === 'ar' ? 'لا، نقدم رحلات للمبتدئين والمحترفين على حد سواء. مدربونا يرشدونك خطوة بخطوة.' : 'No, we offer trips for beginners and professionals alike. Our instructors guide you step by step.'
                ],
                [
                    app()->getLocale() === 'ar' ? 'كيف أحجز رحلتي؟' : 'How do I book a trip?',
                    app()->getLocale() === 'ar' ? 'اختر رحلتك، امل النموذج، وادفع بأمان عبر الإنترنت. ستصلك تأكيد الحجز فوراً.' : 'Choose your trip, fill in the form, and pay securely online. You\'ll receive a booking confirmation instantly.'
                ],
                [
                    app()->getLocale() === 'ar' ? 'ما سياسة الإلغاء؟' : 'What is the cancellation policy?',
                    app()->getLocale() === 'ar' ? 'يمكنك الإلغاء مجاناً حتى 48 ساعة قبل موعد الرحلة. بعد ذلك تُطبق رسوم الإلغاء.' : 'You can cancel for free up to 48 hours before your trip. After that, cancellation fees apply.'
                ],
                [
                    app()->getLocale() === 'ar' ? 'هل المعدات مشمولة في السعر؟' : 'Is equipment included in the price?',
                    app()->getLocale() === 'ar' ? 'نعم، معدات الغوص الأساسية مشمولة. يمكنك إضافة معدات احترافية كإضافة اختيارية.' : 'Yes, basic diving equipment is included. You can add professional equipment as an optional add-on.'
                ],
                [
                    app()->getLocale() === 'ar' ? 'هل هناك خصومات للمجموعات؟' : 'Are there group discounts?',
                    app()->getLocale() === 'ar' ? 'نعم! مجموعات 5+ تحصل على خصم 10%، ومجموعات 10+ تحصل على خصم 15%.' : 'Yes! Groups of 5+ get 10% off, and groups of 10+ get 15% off.'
                ],
                [
                    app()->getLocale() === 'ar' ? 'ما هي وسائل الدفع المتاحة؟' : 'What payment methods are available?',
                    app()->getLocale() === 'ar' ? 'نقبل النقد، بطاقات الائتمان/الخصم، التحويل البنكي، وPayPal.' : 'We accept cash, credit/debit cards, bank transfer, and PayPal.'
                ],
            ] as $index => [$question, $answer])
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open === {{ $index }} ? open = null : open = {{ $index }}"
                            class="w-full flex items-center justify-between px-5 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50 transition">
                        <span>{{ $question }}</span>
                        <svg :class="open === {{ $index }} ? 'rotate-180' : ''"
                             class="w-5 h-5 text-blue-600 transition-transform flex-shrink-0 ml-3"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === {{ $index }}"
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100">
                        <div class="pt-3">{{ $answer }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== NEWSLETTER SECTION ========== --}}
<section class="py-20 px-4 bg-gradient-to-r from-blue-900 to-blue-700">
    <div class="max-w-2xl mx-auto text-center">
        <span class="text-4xl block mb-4">📧</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">
            {{ app()->getLocale() === 'ar' ? 'اشترك في نشرتنا البريدية' : 'Stay in the Loop' }}
        </h2>
        <p class="text-blue-200 text-base mb-8">
            {{ app()->getLocale() === 'ar'
                ? 'احصل على أحدث العروض والرحلات مباشرة في بريدك الإلكتروني'
                : 'Get the latest deals and trips delivered straight to your inbox' }}
        </p>

        @if(session('newsletter_success'))
            <div class="bg-green-500/20 border border-green-400 text-green-200 rounded-xl px-5 py-4 mb-6 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ app()->getLocale() === 'ar' ? 'تم الاشتراك بنجاح! شكراً لك.' : 'Successfully subscribed! Thank you.' }}</span>
            </div>
        @else
            <form action="/newsletter" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                @csrf
                <input type="email"
                       name="email"
                       placeholder="{{ app()->getLocale() === 'ar' ? 'بريدك الإلكتروني' : 'Enter your email' }}"
                       required
                       class="flex-1 px-4 py-3.5 rounded-xl text-gray-800 bg-white border-0 focus:ring-2 focus:ring-cyan-400 outline-none text-sm">
                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3.5 rounded-xl font-semibold text-sm transition whitespace-nowrap">
                    {{ app()->getLocale() === 'ar' ? 'اشترك الآن' : 'Subscribe' }}
                </button>
            </form>
            @error('email')
                <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
            @enderror
        @endif

        <p class="text-blue-300/60 text-xs mt-4">
            {{ app()->getLocale() === 'ar' ? 'لن نرسل لك بريداً مزعجاً أبداً.' : 'No spam, ever. Unsubscribe anytime.' }}
        </p>
    </div>
</section>

@endsection
