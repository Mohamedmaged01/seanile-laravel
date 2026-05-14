@extends('layouts.app')

@section('title', $trip->getLocalizedTitle() . ' – SeaNile')

@section('content')
<!-- Hero -->
<section class="relative h-80 md:h-96 bg-gray-900">
    @if($trip->image)
    <img src="{{ asset($trip->image) }}" alt="{{ $trip->getLocalizedTitle() }}" class="w-full h-full object-cover opacity-70">
    @else
    <div class="w-full h-full bg-gradient-to-r from-blue-800 to-cyan-600"></div>
    @endif
    <div class="absolute inset-0 flex items-end pb-8 px-4">
        <div class="max-w-7xl mx-auto w-full">
            @if($trip->badge)
            <span class="inline-block bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full mb-3">
                {{ __('messages.badge_' . $trip->badge) }}
            </span>
            @endif
            <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $trip->getLocalizedTitle() }}</h1>
            <p class="text-cyan-300 mt-1">{{ $trip->destination?->getLocalizedName() }}</p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-gray-50 py-3 px-4 border-b">
    <div class="max-w-7xl mx-auto text-sm text-gray-500">
        <a href="/" class="hover:text-blue-600">{{ __('messages.nav_home') }}</a>
        <span class="mx-2">/</span>
        <a href="/trips" class="hover:text-blue-600">{{ __('messages.nav_trips') }}</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800">{{ $trip->getLocalizedTitle() }}</span>
    </div>
</div>

<!-- Content -->
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Left: Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Description -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('messages.nav_trips') }}</h2>
                <p class="text-gray-600 leading-relaxed text-lg">{{ $trip->getLocalizedDescription() }}</p>
            </div>

            <!-- Highlights -->
            @if($trip->highlights && count($trip->highlights) > 0)
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('messages.highlights') }}</h3>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($trip->highlights as $highlight)
                    <li class="flex items-center gap-2 text-gray-700">
                        <span class="text-green-500 font-bold">✓</span>
                        {{ $highlight }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Includes -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('messages.includes') }}</h3>
                <div class="flex flex-wrap gap-4">
                    @if($trip->includes_food)
                    <div class="flex items-center gap-2 bg-green-50 text-green-700 px-4 py-2 rounded-xl">
                        <span>🍽️</span><span>Food & Drinks</span>
                    </div>
                    @endif
                    @if($trip->includes_insurance)
                    <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-xl">
                        <span>🛡️</span><span>Insurance</span>
                    </div>
                    @endif
                    @if($trip->includes_pickup)
                    <div class="flex items-center gap-2 bg-purple-50 text-purple-700 px-4 py-2 rounded-xl">
                        <span>🚐</span><span>Hotel Pickup</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right: Booking Card -->
        <div class="lg:col-span-1">
            <div class="sticky top-24 bg-white rounded-2xl shadow-lg border p-6">
                <div class="text-center mb-6">
                    @if($trip->original_price && $trip->original_price > $trip->price)
                    <p class="text-gray-400 line-through text-sm">${{ number_format($trip->original_price, 0) }}</p>
                    @endif
                    <p class="text-4xl font-bold text-blue-600">${{ number_format($trip->price, 0) }}</p>
                    <p class="text-gray-500 text-sm">{{ __('messages.per_person') }}</p>
                </div>

                <div class="space-y-3 mb-6 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>⏱ {{ __('messages.duration') }}</span>
                        <span class="font-semibold">{{ $trip->duration }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>👥 Group Size</span>
                        <span class="font-semibold">{{ $trip->min_people }}–{{ $trip->max_people }} people</span>
                    </div>
                    <div class="flex justify-between">
                        <span>⭐ Rating</span>
                        <span class="font-semibold">{{ $trip->rating }} ({{ $trip->reviews_count }} {{ __('messages.reviews') }})</span>
                    </div>
                </div>

                <a href="{{ route('booking.create', $trip) }}"
                   class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-xl transition text-lg">
                    {{ __('messages.book_this_trip') }}
                </a>

                <p class="text-center text-gray-400 text-xs mt-3">Free cancellation 48h before trip</p>
            </div>
        </div>
    </div>
</section>

<!-- Related Trips -->
@if($relatedTrips->count() > 0)
<section class="py-12 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">You May Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedTrips as $related)
            <a href="{{ route('trips.show', $related) }}" class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <div class="h-40 bg-gradient-to-r from-blue-500 to-cyan-400 relative">
                    @if($related->image)
                    <img src="{{ asset($related->image) }}" class="w-full h-full object-cover" alt="">
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800">{{ $related->getLocalizedTitle() }}</h3>
                    <p class="text-blue-600 font-semibold">${{ number_format($related->price, 0) }} {{ __('messages.per_person') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
