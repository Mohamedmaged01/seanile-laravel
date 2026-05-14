@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'سياسة الخصوصية – SeaNile' : 'Privacy Policy – SeaNile')
@section('meta_description', 'SeaNile Tourism privacy policy — how we collect, use, and protect your data.')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-3">
            {{ app()->getLocale() === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy' }}
        </h1>
        <p class="text-gray-500 text-sm">
            {{ app()->getLocale() === 'ar' ? 'آخر تحديث: يناير 2024' : 'Last updated: January 2024' }}
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 divide-y divide-gray-100">

        <div class="p-8">
            <p class="text-gray-600 leading-relaxed">
                {{ app()->getLocale() === 'ar'
                    ? 'تلتزم SeaNile للسياحة بحماية خصوصيتك. توضح هذه السياسة كيف نجمع معلوماتك ونستخدمها ونحمايها عند استخدامك لخدماتنا.'
                    : 'SeaNile Tourism is committed to protecting your privacy. This policy explains how we collect, use, and protect your information when you use our services.' }}
            </p>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '1. البيانات التي نجمعها' : '1. Data We Collect' }}
            </h2>
            <ul class="space-y-2 text-gray-600 text-sm">
                @foreach(app()->getLocale() === 'ar' ? [
                    'الاسم الكامل وعنوان البريد الإلكتروني ورقم الهاتف',
                    'معلومات الحجز وتفاصيل الرحلة',
                    'بيانات الدفع (مُشفرة وآمنة)',
                    'معلومات الجنسية وجواز السفر عند الحاجة',
                    'بيانات الاستخدام (الصفحات المزارة، الوقت على الموقع)',
                    'ملفات تعريف الارتباط (Cookies) لتحسين التجربة',
                ] : [
                    'Full name, email address, and phone number',
                    'Booking information and trip details',
                    'Payment data (encrypted and secure)',
                    'Nationality and passport information when required',
                    'Usage data (pages visited, time on site)',
                    'Cookies to improve your browsing experience',
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
                {{ app()->getLocale() === 'ar' ? '2. كيف نستخدم بياناتك' : '2. How We Use Your Data' }}
            </h2>
            <ul class="space-y-2 text-gray-600 text-sm">
                @foreach(app()->getLocale() === 'ar' ? [
                    'معالجة حجوزاتك وتأكيدها',
                    'التواصل معك بشأن رحلاتك',
                    'إرسال تأكيدات وتذكيرات الحجز',
                    'تحسين خدماتنا وتطوير المنتجات',
                    'الامتثال للمتطلبات القانونية',
                    'إرسال عروض خاصة (بموافقتك فقط)',
                ] : [
                    'Process and confirm your bookings',
                    'Communicate with you about your trips',
                    'Send booking confirmations and reminders',
                    'Improve our services and develop new products',
                    'Comply with legal requirements',
                    'Send special offers (only with your consent)',
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
                {{ app()->getLocale() === 'ar' ? '3. أمان البيانات' : '3. Data Security' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ app()->getLocale() === 'ar'
                    ? 'نستخدم تشفير SSL/TLS لحماية بياناتك أثناء الإرسال. بيانات الدفع لا تُخزن على خوادمنا — نستخدم بوابات دفع معتمدة ومشفرة. لا نشارك معلوماتك الشخصية مع أطراف ثالثة دون موافقتك الصريحة، إلا ما تطلبه الجهات القانونية.'
                    : "We use SSL/TLS encryption to protect your data in transit. Payment data is never stored on our servers — we use certified encrypted payment gateways. We do not share your personal information with third parties without your explicit consent, except as required by law." }}
            </p>
        </div>

        <div class="p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? '4. حقوقك' : '4. Your Rights' }}
            </h2>
            <ul class="space-y-2 text-gray-600 text-sm">
                @foreach(app()->getLocale() === 'ar' ? [
                    'الحق في الوصول إلى بياناتك الشخصية',
                    'الحق في تصحيح البيانات غير الدقيقة',
                    'الحق في حذف بياناتك ("الحق في النسيان")',
                    'الحق في تقييد معالجة بياناتك',
                    'الحق في الاعتراض على معالجة بياناتك',
                    'الحق في نقل بياناتك إلى مزود آخر',
                ] : [
                    'Right to access your personal data',
                    'Right to correct inaccurate data',
                    'Right to delete your data ("Right to be Forgotten")',
                    'Right to restrict processing of your data',
                    'Right to object to data processing',
                    'Right to data portability to another provider',
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
                {{ app()->getLocale() === 'ar' ? '5. ملفات تعريف الارتباط' : '5. Cookies' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ app()->getLocale() === 'ar'
                    ? 'نستخدم ملفات تعريف الارتباط الضرورية لعمل الموقع، وملفات تحليلية لفهم كيفية استخدام الزوار للموقع. يمكنك التحكم في إعدادات ملفات تعريف الارتباط من خلال إعدادات متصفحك في أي وقت.'
                    : 'We use essential cookies for site functionality and analytical cookies to understand how visitors use our site. You can control cookie settings through your browser preferences at any time.' }}
            </p>
        </div>

        <div class="p-8 bg-blue-50 rounded-b-2xl">
            <h2 class="text-xl font-bold text-gray-900 mb-3">
                {{ app()->getLocale() === 'ar' ? '6. تواصل معنا' : '6. Contact Us' }}
            </h2>
            <p class="text-gray-600 text-sm mb-4">
                {{ app()->getLocale() === 'ar'
                    ? 'لأي استفسار يتعلق بسياسة الخصوصية أو بياناتك الشخصية:'
                    : 'For any questions about this privacy policy or your personal data:' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="mailto:privacy@seanile.com"
                   class="inline-flex items-center gap-2 text-blue-700 font-semibold text-sm hover:underline">
                    📧 privacy@seanile.com
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
