@extends('layouts.app')

@section('title', __('messages.contact_title') . ' – SeaNile')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-800 to-cyan-600 py-20 px-4 text-white text-center">
    <h1 class="text-4xl font-bold mb-3">{{ __('messages.contact_title') }}</h1>
    <p class="text-cyan-200 text-lg">We're here to help you plan the perfect Red Sea experience</p>
</section>

<section class="py-16 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.contact_name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 @error('name') border-red-400 @enderror">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.contact_email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 @error('email') border-red-400 @enderror">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.contact_phone') }}</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.contact_subject') }}</label>
                    <input type="text" name="subject" value="{{ old('subject') }}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.contact_message') }}</label>
                    <textarea name="message" rows="5"
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition">
                    {{ __('messages.contact_send') }}
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">📞</div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ __('messages.contact_phone_label') }}</h3>
                    <p class="text-gray-600">+20 112 933 8784</p>
                    <p class="text-gray-600">+20 102 634 3822</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">✉️</div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ __('messages.contact_email_label') }}</h3>
                    <p class="text-gray-600">info@seanile.com</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">📍</div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ __('messages.contact_location_label') }}</h3>
                    <p class="text-gray-600">{{ __('messages.contact_location_value') }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 flex items-start gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">⏰</div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ __('messages.contact_hours_label') }}</h3>
                    <p class="text-gray-600">{{ __('messages.contact_hours_value') }}</p>
                </div>
            </div>

            <!-- WhatsApp Quick Chat -->
            <a href="https://wa.me/201129338784" target="_blank"
               class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-2xl transition text-lg">
                <span class="text-2xl">💬</span>
                <span>Chat on WhatsApp</span>
            </a>
        </div>
    </div>
</section>
@endsection
