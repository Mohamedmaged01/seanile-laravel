@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'تم تأكيد الحجز – سي نايل' : 'Booking Confirmed – SeaNile Tourism')

@section('content')

{{-- Success Banner --}}
<section class="py-16 px-4 bg-gradient-to-br from-green-50 to-emerald-50">
    <div class="max-w-2xl mx-auto text-center">

        {{-- Checkmark Icon --}}
        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">
            {{ app()->getLocale() === 'ar' ? 'تم تأكيد الحجز!' : 'Booking Confirmed!' }}
        </h1>
        <p class="text-gray-600 text-base max-w-md mx-auto">
            {{ app()->getLocale() === 'ar'
                ? 'شكراً لحجزك مع سي نايل. ستصلك رسالة تأكيد على بريدك الإلكتروني قريباً.'
                : 'Thank you for booking with SeaNile! A confirmation email will be sent to you shortly.' }}
        </p>
    </div>
</section>

{{-- Booking Details Card --}}
<section class="py-12 px-4 bg-white">
    <div class="max-w-2xl mx-auto">

        {{-- Booking Reference --}}
        <div class="bg-blue-50 border-2 border-blue-200 rounded-2xl p-6 text-center mb-8">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">
                {{ app()->getLocale() === 'ar' ? 'رقم الحجز' : 'Booking Reference' }}
            </p>
            <p class="text-3xl font-extrabold text-blue-800 tracking-widest">
                {{ $booking->booking_number ?? '#SN-000001' }}
            </p>
            <p class="text-xs text-blue-500 mt-2">
                {{ app()->getLocale() === 'ar' ? 'احتفظ بهذا الرقم للمراجعة' : 'Keep this number for your records' }}
            </p>
        </div>

        {{-- Details Grid --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
                <h2 class="font-bold text-gray-800">
                    {{ app()->getLocale() === 'ar' ? 'تفاصيل الحجز' : 'Booking Details' }}
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach([
                    [
                        app()->getLocale() === 'ar' ? 'الرحلة' : 'Trip',
                        $booking->trip?->title ?? ($booking->trip_name ?? 'N/A')
                    ],
                    [
                        app()->getLocale() === 'ar' ? 'تاريخ الرحلة' : 'Trip Date',
                        isset($booking->trip_date) ? $booking->trip_date->format('d M Y') : 'N/A'
                    ],
                    [
                        app()->getLocale() === 'ar' ? 'الاسم' : 'Name',
                        $booking->full_name ?? ($booking->user?->name ?? 'N/A')
                    ],
                    [
                        app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email',
                        $booking->email ?? ($booking->user?->email ?? 'N/A')
                    ],
                    [
                        app()->getLocale() === 'ar' ? 'عدد المسافرين' : 'Travelers',
                        ($booking->adults ?? 1) . ' ' . (app()->getLocale() === 'ar' ? 'بالغ' : 'adult(s)')
                        . (($booking->children ?? 0) > 0 ? ', ' . $booking->children . ' ' . (app()->getLocale() === 'ar' ? 'طفل' : 'child(ren)') : '')
                    ],
                    [
                        app()->getLocale() === 'ar' ? 'طريقة الدفع' : 'Payment Method',
                        ucfirst(str_replace('_', ' ', $booking->payment_method ?? 'cash'))
                    ],
                ] as [$label, $value])
                    <div class="flex items-center justify-between px-6 py-4">
                        <span class="text-sm text-gray-500">{{ $label }}</span>
                        <span class="font-semibold text-gray-800 text-sm">{{ $value }}</span>
                    </div>
                @endforeach

                {{-- Total --}}
                <div class="flex items-center justify-between px-6 py-5 bg-blue-50">
                    <span class="font-bold text-gray-800">{{ app()->getLocale() === 'ar' ? 'الإجمالي' : 'Total Amount' }}</span>
                    <span class="text-2xl font-extrabold text-blue-700">
                        ${{ number_format($booking->total ?? 0, 2) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Next Steps --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-8">
            <h2 class="font-bold text-gray-800 mb-5">
                {{ app()->getLocale() === 'ar' ? 'الخطوات التالية' : 'Next Steps' }}
            </h2>
            <ul class="space-y-4">
                @foreach([
                    ['📧', app()->getLocale() === 'ar' ? 'ستتلقى رسالة تأكيد بريدية تحتوي على جميع التفاصيل.' : 'You\'ll receive a confirmation email with all the details.'],
                    ['📞', app()->getLocale() === 'ar' ? 'سيتصل بك فريقنا خلال 24 ساعة لتأكيد الترتيبات.' : 'Our team will call you within 24 hours to confirm arrangements.'],
                    ['🚐', app()->getLocale() === 'ar' ? 'سيتم استقبالك من فندقك في يوم الرحلة في الوقت المحدد.' : 'You\'ll be picked up from your hotel on the trip day at the agreed time.'],
                    ['🤿', app()->getLocale() === 'ar' ? 'استعد للاستمتاع بتجربة لا تُنسى في البحر الأحمر!' : 'Get ready for an unforgettable Red Sea experience!'],
                ] as [$icon, $text])
                    <li class="flex items-start gap-4">
                        <span class="text-2xl flex-shrink-0">{{ $icon }}</span>
                        <p class="text-sm text-gray-600 leading-relaxed pt-1">{{ $text }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Important Info --}}
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 mb-8">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-semibold text-yellow-800 text-sm mb-1">
                        {{ app()->getLocale() === 'ar' ? 'تذكير مهم' : 'Important Reminder' }}
                    </p>
                    <p class="text-yellow-700 text-xs leading-relaxed">
                        {{ app()->getLocale() === 'ar'
                            ? 'يمكن الإلغاء مجاناً حتى 48 ساعة قبل موعد الرحلة. لأي استفسار، تواصل معنا عبر واتساب أو البريد الإلكتروني.'
                            : 'Free cancellation is available up to 48 hours before your trip. For any questions, contact us via WhatsApp or email.' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="/dashboard"
               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-xl font-bold text-center transition shadow-md">
                {{ app()->getLocale() === 'ar' ? 'عرض لوحة التحكم' : 'View My Dashboard' }}
            </a>
            <a href="/trips"
               class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-4 rounded-xl font-bold text-center transition">
                {{ app()->getLocale() === 'ar' ? 'استكشف المزيد من الرحلات' : 'Explore More Trips' }}
            </a>
        </div>

        {{-- WhatsApp Support --}}
        <div class="text-center mt-8 pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-500 mb-3">
                {{ app()->getLocale() === 'ar' ? 'هل لديك سؤال؟ نحن هنا للمساعدة!' : 'Have a question? We\'re here to help!' }}
            </p>
            <a href="https://wa.me/201129338784"
               target="_blank"
               class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                {{ app()->getLocale() === 'ar' ? 'تواصل عبر واتساب' : 'Chat on WhatsApp' }}
            </a>
        </div>
    </div>
</section>

@endsection
