@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'احجز رحلتك – سي نايل' : 'Book Your Trip – SeaNile Tourism')

@section('content')

{{-- Page Header --}}
<section class="py-10 px-4 bg-gradient-to-br from-blue-900 to-blue-700 text-white text-center">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-2">
            {{ app()->getLocale() === 'ar' ? 'احجز رحلتك' : 'Book Your Trip' }}
        </h1>
        <p class="text-blue-200">
            {{ app()->getLocale() === 'ar' ? 'أكمل بياناتك لتأكيد الحجز' : 'Complete your details to confirm the booking' }}
        </p>
    </div>
</section>

<section class="py-12 px-4 bg-gray-50">
    <div class="max-w-4xl mx-auto">

        {{-- Trip Summary Card --}}
        @if(isset($trip))
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-8 flex flex-col sm:flex-row gap-5 items-start">
                <div class="w-full sm:w-32 h-24 rounded-xl overflow-hidden flex-shrink-0">
                    @if($trip->image)
                        <img src="{{ asset('storage/' . $trip->image) }}"
                             alt="{{ $trip->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-3xl">🤿</div>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            @if($trip->category)
                                <span class="text-xs font-bold bg-orange-100 text-orange-600 px-2.5 py-1 rounded-full uppercase">{{ $trip->category }}</span>
                            @endif
                            <h2 class="text-lg font-bold text-gray-900 mt-1">
                                {{ app()->getLocale() === 'ar' && isset($trip->title_ar) ? $trip->title_ar : $trip->title }}
                            </h2>
                            @if($trip->destination)
                                <p class="text-sm text-gray-500 mt-0.5">📍 {{ $trip->destination }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-extrabold text-blue-700">${{ number_format($trip->price, 0) }}</p>
                            <p class="text-xs text-gray-500">{{ app()->getLocale() === 'ar' ? 'لكل شخص' : 'per person' }}</p>
                            @if($trip->duration)
                                <p class="text-xs text-gray-500 mt-1">⏱ {{ $trip->duration }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Booking Form --}}
        <form action="/booking" method="POST" class="space-y-6">
            @csrf
            @if(isset($trip))
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
            @endif

            {{-- Validation Errors Summary --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <p class="font-semibold text-red-700 text-sm mb-2">
                        {{ app()->getLocale() === 'ar' ? 'يرجى تصحيح الأخطاء التالية:' : 'Please fix the following errors:' }}
                    </p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-red-600 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- SECTION 1: Your Information --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <span class="w-6 h-6 bg-white/20 rounded-full text-xs flex items-center justify-center font-bold">1</span>
                        {{ app()->getLocale() === 'ar' ? 'معلوماتك الشخصية' : 'Your Information' }}
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name"
                               value="{{ old('full_name', auth()->user()?->name) }}"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}"
                               class="w-full px-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none {{ $errors->has('full_name') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', auth()->user()?->email) }}"
                               placeholder="your@email.com"
                               class="w-full px-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none {{ $errors->has('email') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone"
                               value="{{ old('phone', auth()->user()?->phone) }}"
                               placeholder="+20 1XX XXX XXXX"
                               class="w-full px-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none {{ $errors->has('phone') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'الجنسية' : 'Nationality' }} <span class="text-red-500">*</span>
                        </label>
                        <select name="nationality"
                                class="w-full px-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none bg-white {{ $errors->has('nationality') ? 'border-red-400' : 'border-gray-300' }}">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر جنسيتك' : 'Select nationality' }}</option>
                            @foreach(['EG' => 'Egyptian', 'SA' => 'Saudi Arabian', 'AE' => 'Emirati', 'US' => 'American', 'GB' => 'British', 'DE' => 'German', 'FR' => 'French', 'IT' => 'Italian', 'RU' => 'Russian', 'CN' => 'Chinese', 'IN' => 'Indian', 'Other' => 'Other'] as $code => $name)
                                <option value="{{ $code }}" {{ old('nationality') === $code ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('nationality') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'اسم الفندق' : 'Hotel Name' }}
                            <span class="text-gray-400 font-normal text-xs">({{ app()->getLocale() === 'ar' ? 'لخدمة الاستقبال' : 'for pickup service' }})</span>
                        </label>
                        <input type="text" name="hotel" value="{{ old('hotel') }}"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'اسم فندقك في الغردقة' : 'Your hotel name in Hurghada' }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            {{-- SECTION 2: Trip Details --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <span class="w-6 h-6 bg-white/20 rounded-full text-xs flex items-center justify-center font-bold">2</span>
                        {{ app()->getLocale() === 'ar' ? 'تفاصيل الرحلة' : 'Trip Details' }}
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'تاريخ الرحلة' : 'Trip Date' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="trip_date" value="{{ old('trip_date') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none {{ $errors->has('trip_date') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('trip_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'الوقت المفضل' : 'Preferred Time' }}
                        </label>
                        <select name="preferred_time"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الوقت' : 'Select time' }}</option>
                            <option value="morning" {{ old('preferred_time') === 'morning' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'صباحاً (8:00–12:00)' : 'Morning (8:00–12:00)' }}</option>
                            <option value="afternoon" {{ old('preferred_time') === 'afternoon' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'بعد الظهر (12:00–17:00)' : 'Afternoon (12:00–17:00)' }}</option>
                            <option value="full_day" {{ old('preferred_time') === 'full_day' ? 'selected' : '' }}>{{ app()->getLocale() === 'ar' ? 'يوم كامل' : 'Full Day' }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'البالغون' : 'Adults' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="adults" value="{{ old('adults', 1) }}" min="1" max="20"
                               class="w-full px-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none {{ $errors->has('adults') ? 'border-red-400' : 'border-gray-300' }}">
                        @error('adults') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'الأطفال (3–12 سنة)' : 'Children (3–12 yrs)' }}
                        </label>
                        <input type="number" name="children" value="{{ old('children', 0) }}" min="0" max="20"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'الرضع (أقل من 3 سنوات)' : 'Infants (Under 3 yrs)' }}
                            <span class="text-green-600 text-xs font-normal">({{ app()->getLocale() === 'ar' ? 'مجاناً' : 'Free' }})</span>
                        </label>
                        <input type="number" name="infants" value="{{ old('infants', 0) }}" min="0" max="5"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            {{-- SECTION 3: Add-ons --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <span class="w-6 h-6 bg-white/20 rounded-full text-xs flex items-center justify-center font-bold">3</span>
                        {{ app()->getLocale() === 'ar' ? 'الإضافات (اختياري)' : 'Add-ons (Optional)' }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach([
                            ['vip_transfer', '🚖', app()->getLocale() === 'ar' ? 'نقل VIP' : 'VIP Transfer', '$30'],
                            ['private_guide', '🧑‍✈️', app()->getLocale() === 'ar' ? 'مرشد خاص' : 'Private Guide', '$50'],
                            ['diving_equip', '🤿', app()->getLocale() === 'ar' ? 'معدات غوص احترافية' : 'Diving Equipment', '$25'],
                            ['photography', '📸', app()->getLocale() === 'ar' ? 'تصوير احترافي' : 'Photography', '$40'],
                            ['insurance', '🛡️', app()->getLocale() === 'ar' ? 'تأمين إضافي' : 'Extra Insurance', '$10'],
                            ['meals', '🍽️', app()->getLocale() === 'ar' ? 'وجبات كاملة' : 'Full Meals Package', '$20'],
                        ] as [$name, $icon, $label, $price])
                            <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                                <input type="checkbox"
                                       name="addons[]"
                                       value="{{ $name }}"
                                       {{ in_array($name, old('addons', [])) ? 'checked' : '' }}
                                       class="w-4 h-4 accent-blue-600 flex-shrink-0">
                                <span class="text-xl flex-shrink-0">{{ $icon }}</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">{{ $label }}</p>
                                    <p class="text-xs text-blue-600 font-bold">+ {{ $price }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- SECTION 4: Special Requests --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <span class="w-6 h-6 bg-white/20 rounded-full text-xs flex items-center justify-center font-bold">4</span>
                        {{ app()->getLocale() === 'ar' ? 'طلبات خاصة' : 'Special Requests' }}
                    </h3>
                </div>
                <div class="p-6">
                    <textarea name="special_requests" rows="3"
                              placeholder="{{ app()->getLocale() === 'ar' ? 'أي طلبات أو ملاحظات خاصة...' : 'Any special requests, dietary needs, or accessibility requirements...' }}"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('special_requests') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1.5">
                        {{ app()->getLocale() === 'ar' ? 'لا تضمن الطلبات الخاصة ولكن سنبذل قصارى جهدنا.' : 'Special requests are not guaranteed but we\'ll do our best.' }}
                    </p>
                </div>
            </div>

            {{-- SECTION 5: Payment Method --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <span class="w-6 h-6 bg-white/20 rounded-full text-xs flex items-center justify-center font-bold">5</span>
                        {{ app()->getLocale() === 'ar' ? 'طريقة الدفع' : 'Payment Method' }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
                        @foreach([
                            ['cash', '💵', app()->getLocale() === 'ar' ? 'نقداً' : 'Cash'],
                            ['card', '💳', app()->getLocale() === 'ar' ? 'بطاقة ائتمان' : 'Credit Card'],
                            ['bank_transfer', '🏦', app()->getLocale() === 'ar' ? 'تحويل بنكي' : 'Bank Transfer'],
                            ['paypal', '🅿️', 'PayPal'],
                        ] as [$val, $icon, $label])
                            <label class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition text-center">
                                <input type="radio" name="payment_method" value="{{ $val }}"
                                       {{ old('payment_method', 'cash') === $val ? 'checked' : '' }}
                                       class="sr-only">
                                <span class="text-2xl">{{ $icon }}</span>
                                <span class="text-xs font-semibold text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('payment_method') <p class="text-red-500 text-xs mb-4">{{ $message }}</p> @enderror

                    {{-- Promo Code --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ app()->getLocale() === 'ar' ? 'كود الخصم' : 'Promo Code' }}
                            <span class="text-gray-400 font-normal text-xs">({{ app()->getLocale() === 'ar' ? 'اختياري' : 'optional' }})</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" name="promo_code" value="{{ old('promo_code') }}"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل كود الخصم' : 'Enter promo code' }}"
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none uppercase">
                            <button type="button"
                                    class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-semibold transition">
                                {{ app()->getLocale() === 'ar' ? 'تطبيق' : 'Apply' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-500 space-y-1">
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            {{ app()->getLocale() === 'ar' ? 'حجز آمن ومشفر' : 'Secure & encrypted booking' }}
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ app()->getLocale() === 'ar' ? 'إلغاء مجاني حتى 48 ساعة قبل الرحلة' : 'Free cancellation up to 48 hours before' }}
                        </p>
                    </div>
                    <button type="submit"
                            class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-xl font-bold text-lg transition shadow-md hover:shadow-lg">
                        {{ app()->getLocale() === 'ar' ? 'تأكيد الحجز' : 'Confirm Booking' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
