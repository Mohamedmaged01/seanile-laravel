@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'لوحة التحكم – سي نايل' : 'My Dashboard – SeaNile Tourism')

@section('content')

{{-- Page Header --}}
<section class="py-10 px-4 bg-gradient-to-br from-blue-900 to-blue-700 text-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <p class="text-blue-300 text-sm mb-1">
                    {{ app()->getLocale() === 'ar' ? 'مرحباً بعودتك' : 'Welcome back' }} 👋
                </p>
                <h1 class="text-2xl sm:text-3xl font-extrabold">
                    {{ auth()->user()->name }}
                </h1>
            </div>
            <a href="/trips"
               class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition">
                {{ app()->getLocale() === 'ar' ? '+ حجز رحلة جديدة' : '+ Book New Trip' }}
            </a>
        </div>
    </div>
</section>

{{-- Stats Row --}}
<section class="px-4 -mt-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([
                [
                    'value' => isset($totalBookings) ? $totalBookings : 0,
                    'label' => app()->getLocale() === 'ar' ? 'إجمالي الحجوزات' : 'Total Bookings',
                    'icon' => '📋',
                    'color' => 'blue',
                ],
                [
                    'value' => '$' . number_format(isset($totalSpent) ? $totalSpent : 0, 0),
                    'label' => app()->getLocale() === 'ar' ? 'إجمالي الإنفاق' : 'Total Spent',
                    'icon' => '💰',
                    'color' => 'green',
                ],
                [
                    'value' => isset($upcomingCount) ? $upcomingCount : 0,
                    'label' => app()->getLocale() === 'ar' ? 'الرحلات القادمة' : 'Upcoming Trips',
                    'icon' => '🗓️',
                    'color' => 'orange',
                ],
            ] as $stat)
                <div class="bg-white rounded-2xl shadow-md p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-{{ $stat['color'] === 'orange' ? 'orange' : ($stat['color'] === 'green' ? 'green' : 'blue') }}-50 flex items-center justify-center text-3xl flex-shrink-0">
                        {{ $stat['icon'] }}
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-gray-900">{{ $stat['value'] }}</p>
                        <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Upcoming Trips --}}
<section class="py-10 px-4">
    <div class="max-w-7xl mx-auto">

        @if(isset($upcomingBookings) && $upcomingBookings->count())
            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-2">
                    🗓️ {{ app()->getLocale() === 'ar' ? 'الرحلات القادمة' : 'Upcoming Trips' }}
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($upcomingBookings as $booking)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                            <div class="h-36 relative">
                                @if($booking->trip?->image)
                                    <img src="{{ asset($booking->trip->image) }}"
                                         alt="{{ $booking->trip?->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-4xl">🤿</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-blue-600 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                                        {{ app()->getLocale() === 'ar' ? 'قادمة' : 'Upcoming' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 text-sm mb-1 line-clamp-1">
                                    {{ $booking->trip?->title ?? 'N/A' }}
                                </h3>
                                <p class="text-xs text-gray-500 mb-3">
                                    📅 {{ isset($booking->trip_date) ? $booking->trip_date->format('d M Y') : 'N/A' }}
                                    · {{ $booking->adults ?? 1 }} {{ app()->getLocale() === 'ar' ? 'بالغ' : 'adult(s)' }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-blue-700">${{ number_format($booking->total ?? 0, 0) }}</span>
                                    <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full">
                                        #{{ $booking->booking_number }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Booking History Table --}}
        <div>
            <h2 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-2">
                📋 {{ app()->getLocale() === 'ar' ? 'سجل الحجوزات' : 'Booking History' }}
            </h2>

            @if(isset($bookings) && $bookings->count())
                {{-- Desktop Table --}}
                <div class="hidden md:block bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    @foreach([
                                        app()->getLocale() === 'ar' ? 'رقم الحجز' : 'Booking #',
                                        app()->getLocale() === 'ar' ? 'الرحلة' : 'Trip',
                                        app()->getLocale() === 'ar' ? 'التاريخ' : 'Date',
                                        app()->getLocale() === 'ar' ? 'المسافرون' : 'Travelers',
                                        app()->getLocale() === 'ar' ? 'الإجمالي' : 'Total',
                                        app()->getLocale() === 'ar' ? 'الحالة' : 'Status',
                                        app()->getLocale() === 'ar' ? 'إجراءات' : 'Actions',
                                    ] as $header)
                                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            {{ $header }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-5 py-4">
                                            <span class="font-mono font-semibold text-blue-700 text-xs bg-blue-50 px-2.5 py-1 rounded-lg">
                                                {{ $booking->booking_number }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <p class="font-medium text-gray-800 line-clamp-1">
                                                {{ $booking->trip?->title ?? 'N/A' }}
                                            </p>
                                            @if($booking->trip?->destination)
                                                <p class="text-xs text-gray-400 mt-0.5">{{ $booking->trip->destination }}</p>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-gray-600">
                                            {{ isset($booking->trip_date) ? $booking->trip_date->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $booking->adults ?? 1 }}A
                                            @if(($booking->children ?? 0) > 0)
                                                / {{ $booking->children }}C
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 font-bold text-gray-800">
                                            ${{ number_format($booking->total ?? 0, 0) }}
                                        </td>
                                        <td class="px-5 py-4">
                                            @php
                                                $statusConfig = [
                                                    'pending'   => ['bg-yellow-100 text-yellow-800', app()->getLocale() === 'ar' ? 'معلق' : 'Pending'],
                                                    'confirmed' => ['bg-blue-100 text-blue-800', app()->getLocale() === 'ar' ? 'مؤكد' : 'Confirmed'],
                                                    'completed' => ['bg-green-100 text-green-800', app()->getLocale() === 'ar' ? 'مكتمل' : 'Completed'],
                                                    'cancelled' => ['bg-red-100 text-red-800', app()->getLocale() === 'ar' ? 'ملغى' : 'Cancelled'],
                                                ];
                                                $status = $booking->status ?? 'pending';
                                                [$classes, $label] = $statusConfig[$status] ?? ['bg-gray-100 text-gray-700', ucfirst($status)];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $classes }}">
                                                {{ $label }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <a href="/trips/{{ $booking->trip_id }}"
                                               class="text-blue-600 hover:text-blue-700 text-xs font-semibold hover:underline">
                                                {{ app()->getLocale() === 'ar' ? 'عرض' : 'View' }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Mobile Cards --}}
                <div class="md:hidden space-y-4">
                    @foreach($bookings as $booking)
                        @php
                            $status = $booking->status ?? 'pending';
                            $statusConfig = [
                                'pending'   => ['bg-yellow-100 text-yellow-800', app()->getLocale() === 'ar' ? 'معلق' : 'Pending'],
                                'confirmed' => ['bg-blue-100 text-blue-800', app()->getLocale() === 'ar' ? 'مؤكد' : 'Confirmed'],
                                'completed' => ['bg-green-100 text-green-800', app()->getLocale() === 'ar' ? 'مكتمل' : 'Completed'],
                                'cancelled' => ['bg-red-100 text-red-800', app()->getLocale() === 'ar' ? 'ملغى' : 'Cancelled'],
                            ];
                            [$classes, $label] = $statusConfig[$status] ?? ['bg-gray-100 text-gray-700', ucfirst($status)];
                        @endphp
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-start justify-between mb-3">
                                <span class="font-mono font-semibold text-blue-700 text-xs bg-blue-50 px-2.5 py-1 rounded-lg">
                                    {{ $booking->booking_number }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $classes }}">
                                    {{ $label }}
                                </span>
                            </div>
                            <p class="font-semibold text-gray-800 text-sm mb-1">{{ $booking->trip?->title ?? 'N/A' }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>📅 {{ isset($booking->trip_date) ? $booking->trip_date->format('d M Y') : 'N/A' }}</span>
                                <span class="font-bold text-gray-800">${{ number_format($booking->total ?? 0, 0) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->hasPages())
                    <div class="mt-8">
                        {{ $bookings->links() }}
                    </div>
                @endif

            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 text-center py-16 px-8">
                    <span class="text-5xl block mb-4">🌊</span>
                    <h3 class="text-lg font-bold text-gray-700 mb-2">
                        {{ app()->getLocale() === 'ar' ? 'لا توجد حجوزات بعد' : 'No bookings yet' }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-6">
                        {{ app()->getLocale() === 'ar'
                            ? 'ابدأ مغامرتك الأولى في البحر الأحمر اليوم!'
                            : 'Start your first Red Sea adventure today!' }}
                    </p>
                    <a href="/trips"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                        {{ app()->getLocale() === 'ar' ? 'استكشف الرحلات' : 'Explore Trips' }}
                    </a>
                </div>
            @endif
        </div>

        {{-- Profile Quick Edit --}}
        <div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">
                👤 {{ app()->getLocale() === 'ar' ? 'معلومات حسابي' : 'My Account Info' }}
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">{{ app()->getLocale() === 'ar' ? 'الاسم' : 'Name' }}</p>
                    <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">{{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}</p>
                    <p class="font-semibold text-gray-800">{{ auth()->user()->email }}</p>
                </div>
                @if(auth()->user()->phone)
                    <div>
                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">{{ app()->getLocale() === 'ar' ? 'الهاتف' : 'Phone' }}</p>
                        <p class="font-semibold text-gray-800">{{ auth()->user()->phone }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
