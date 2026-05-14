@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'الشروط والأحكام – SeaNile' : 'Terms & Conditions – SeaNile')
@section('meta_description', 'SeaNile Tourism terms and conditions — booking, payment, and cancellation policy.')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-3">
            {{ app()->getLocale() === 'ar' ? 'الشروط والأحكام' : 'Terms & Conditions' }}
        </h1>
        <p class="text-gray-500 text-sm">
            {{ app()->getLocale() === 'ar' ? 'آخر تحديث: يناير 2024' : 'Last updated: January 2024' }}
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 divide-y divide-gray-100">

        <div class="p-8">
            <p class="text-gray-600 leading-relaxed">
                {{ app()->getLocale() === 'ar'
                    ? 'باستخدامك لخدمات SeaNile للسياحة وإجرائك أي حجز، فإنك توافق على الشروط والأحكام التالية. يرجى قراءتها بعناية قبل إتمام أي حجز.'
                    : 'By using SeaNile Tourism services and making any booking, you agree to the following terms and conditions. Please read them carefully before completing any booking.' }}
            </p>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '1. شروط الحجز' : '1. Booking Terms' }}
            </h2>
            <ul class="space-y-2 text-gray-600 text-sm">
                @foreach(app()->getLocale() === 'ar' ? [
                    'الحجز مؤكد فقط بعد استلام التأكيد الرسمي عبر البريد الإلكتروني',
                    'يجب أن يكون عمر قائد المجموعة 18 سنة أو أكثر',
                    'المعلومات المقدمة عند الحجز يجب أن تكون دقيقة وصحيحة',
                    'SeaNile تحتفظ بحق رفض أي حجز دون الإفصاح عن أسباب',
                    'أسعار الرحلات خاضعة للتغيير حتى يتم تأكيد الحجز',
                ] : [
                    'A booking is only confirmed upon receiving official email confirmation',
                    'The group leader must be 18 years of age or older',
                    'Information provided at booking must be accurate and truthful',
                    'SeaNile reserves the right to refuse any booking without stating reasons',
                    'Trip prices are subject to change until the booking is confirmed',
                ] as $item)
                    <li class="flex items-start gap-2">
                        <span class="text-blue-500 mt-1 flex-shrink-0">•</span>
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '2. شروط الدفع' : '2. Payment Terms' }}
            </h2>
            <ul class="space-y-2 text-gray-600 text-sm">
                @foreach(app()->getLocale() === 'ar' ? [
                    'يمكن الدفع نقداً أو ببطاقة الائتمان أو التحويل البنكي أو PayPal',
                    'الدفع الكامل مطلوب لتأكيد الحجز',
                    'جميع الأسعار بالدولار الأمريكي ما لم يُذكر خلاف ذلك',
                    'الضرائب المصرية (14%) مشمولة في السعر المعروض',
                    'رسوم العمولات البنكية على عاتق العميل',
                ] : [
                    'Payment can be made by cash, credit card, bank transfer, or PayPal',
                    'Full payment is required to confirm a booking',
                    'All prices are in US Dollars unless stated otherwise',
                    'Egyptian taxes (14%) are included in the displayed price',
                    'Bank commission fees are the responsibility of the client',
                ] as $item)
                    <li class="flex items-start gap-2">
                        <span class="text-blue-500 mt-1 flex-shrink-0">•</span>
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-5">
                {{ app()->getLocale() === 'ar' ? '3. سياسة الإلغاء والاسترداد' : '3. Cancellation & Refund Policy' }}
            </h2>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-blue-50">
                            <th class="text-start px-5 py-3 font-semibold text-gray-700 border-b border-gray-200">
                                {{ app()->getLocale() === 'ar' ? 'وقت الإلغاء' : 'Cancellation Time' }}
                            </th>
                            <th class="text-start px-5 py-3 font-semibold text-gray-700 border-b border-gray-200">
                                {{ app()->getLocale() === 'ar' ? 'نسبة الاسترداد' : 'Refund Amount' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(app()->getLocale() === 'ar' ? [
                            ['أكثر من 48 ساعة قبل الرحلة',        'استرداد كامل 100%',        'text-green-600',  'bg-green-50'],
                            ['24 – 48 ساعة قبل الرحلة',            'استرداد 80%',               'text-yellow-600', 'bg-yellow-50'],
                            ['12 – 24 ساعة قبل الرحلة',            'استرداد 50%',               'text-orange-600', 'bg-orange-50'],
                            ['أقل من 12 ساعة / عدم الحضور',        'لا يوجد استرداد',           'text-red-600',    'bg-red-50'],
                        ] : [
                            ['More than 48 hours before trip', 'Full refund 100%', 'text-green-600',  'bg-green-50'],
                            ['24 – 48 hours before trip',      '80% refund',       'text-yellow-600', 'bg-yellow-50'],
                            ['12 – 24 hours before trip',      '50% refund',       'text-orange-600', 'bg-orange-50'],
                            ['Under 12 hours / No-show',       'No refund',        'text-red-600',    'bg-red-50'],
                        ] as [$time, $refund, $color, $bg])
                            <tr class="border-b border-gray-100 last:border-0">
                                <td class="px-5 py-3.5 text-gray-600">{{ $time }}</td>
                                <td class="px-5 py-3.5 font-semibold {{ $color }}">{{ $refund }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-xs text-gray-400 mt-3">
                {{ app()->getLocale() === 'ar'
                    ? '* يحق لـ SeaNile إلغاء الرحلات في حالات سوء الأحوال الجوية أو الظروف الطارئة مع استرداد كامل.'
                    : '* SeaNile reserves the right to cancel trips due to bad weather or emergencies, with full refunds provided.' }}
            </p>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '4. المسؤولية والسلامة' : '4. Liability & Safety' }}
            </h2>
            <ul class="space-y-2 text-gray-600 text-sm">
                @foreach(app()->getLocale() === 'ar' ? [
                    'جميع مرشدينا حاصلون على شهادات دولية معتمدة',
                    'يُقرّ العملاء بأنهم على علم بالمخاطر الطبيعية المرتبطة بأنشطة البحر والصحراء',
                    'تأمين السفر الاختياري متاح وينصح به بشدة',
                    'SeaNile غير مسؤولة عن الأمتعة أو الأشياء الشخصية',
                    'يجب الإفصاح عن أي حالات صحية مسبقاً قبل المشاركة',
                ] : [
                    'All our guides hold internationally accredited certifications',
                    'Clients acknowledge awareness of inherent risks in sea and desert activities',
                    'Optional travel insurance is available and strongly recommended',
                    'SeaNile is not liable for luggage or personal belongings',
                    'Any medical conditions must be disclosed in advance before participating',
                ] as $item)
                    <li class="flex items-start gap-2">
                        <span class="text-blue-500 mt-1 flex-shrink-0">•</span>
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '5. قواعد السلوك' : '5. Code of Conduct' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ app()->getLocale() === 'ar'
                    ? 'يجب على جميع المشاركين احترام البيئة البحرية والصحراوية، واتباع تعليمات المرشدين في جميع الأوقات، واحترام الثقافة والتقاليد المحلية. يحق لـ SeaNile إنهاء مشاركة أي شخص يُشكل خطراً على نفسه أو على الآخرين دون استرداد المبلغ.'
                    : 'All participants must respect the marine and desert environment, follow guide instructions at all times, and respect local culture and traditions. SeaNile reserves the right to end the participation of anyone who poses a risk to themselves or others without a refund.' }}
            </p>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '6. التعديلات' : '6. Modifications' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ app()->getLocale() === 'ar'
                    ? 'تحتفظ SeaNile بحق تعديل هذه الشروط في أي وقت. التعديلات تسري من تاريخ نشرها على الموقع. استمرار استخدامك للخدمة يعني قبولك للشروط المحدّثة.'
                    : 'SeaNile reserves the right to modify these terms at any time. Changes take effect from the date they are published on the site. Continued use of our service implies acceptance of the updated terms.' }}
            </p>
        </div>

        <div class="p-8 bg-blue-50 rounded-b-2xl">
            <h2 class="text-xl font-bold text-gray-900 mb-3">
                {{ app()->getLocale() === 'ar' ? '7. حل النزاعات' : '7. Dispute Resolution' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                {{ app()->getLocale() === 'ar'
                    ? 'تُحكم هذه الشروط بموجب قانون جمهورية مصر العربية. في حالة أي نزاع، يرجى التواصل معنا أولاً للوصول إلى حل ودي.'
                    : 'These terms are governed by Egyptian law. In case of any dispute, please contact us first to reach an amicable resolution.' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="mailto:legal@seanile.com"
                   class="inline-flex items-center gap-2 text-blue-700 font-semibold text-sm hover:underline">
                    📧 legal@seanile.com
                </a>
                <a href="tel:+201129338784"
                   class="inline-flex items-center gap-2 text-blue-700 font-semibold text-sm hover:underline">
                    📞 +20 112 933 8784
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
