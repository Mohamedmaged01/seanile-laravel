@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'عن SeaNile – من نحن' : 'About Us – SeaNile Tourism')
@section('meta_description', 'Learn about SeaNile Tourism — Egypt\'s leading Red Sea adventure company based in Hurghada.')

@section('content')

{{-- Hero --}}
<section class="relative py-24 px-4 bg-gradient-to-br from-blue-700 to-cyan-600 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="inline-block bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
            {{ app()->getLocale() === 'ar' ? 'تعرف علينا' : 'Get to Know Us' }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-5">
            {{ app()->getLocale() === 'ar' ? 'عن SeaNile' : 'About SeaNile' }}
        </h1>
        <p class="text-white/85 text-lg max-w-2xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'ar'
                ? 'شركة رائدة في السياحة البحرية بمصر منذ 2015، نُقدم تجارب لا تُنسى في قلب البحر الأحمر'
                : "Egypt's leading marine tourism company since 2015, delivering unforgettable experiences in the heart of the Red Sea" }}
        </p>
    </div>
</section>

{{-- Our Story --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
            <div>
                <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-3">
                    {{ app()->getLocale() === 'ar' ? 'قصتنا' : 'Our Story' }}
                </p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'بدأنا بحلم صغير' : 'Started With a Small Dream' }}
                </h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'في عام 2015، بدأت SeaNile برحلة واحدة وفريق من ثلاثة أشخاص يؤمنون بأن البحر الأحمر يستحق أن يُشاركه العالم. اليوم، نخدم أكثر من 10,000 عميل سنوياً من 50+ دولة.'
                            : 'In 2015, SeaNile started with a single boat and a team of three who believed the Red Sea deserved to be shared with the world. Today, we serve over 10,000 clients annually from 50+ countries.' }}
                    </p>
                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'نؤمن أن كل رحلة هي قصة تستحق أن تُروى. لذلك نحرص على تقديم أعلى مستويات السلامة والاحترافية والمتعة في كل تجربة.'
                            : "We believe every trip is a story worth telling. That's why we ensure the highest standards of safety, professionalism, and fun in every experience." }}
                    </p>
                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'من الشعاب المرجانية الزاهية إلى الصحراء الذهبية، نأخذك في رحلة تجمع جمال مصر المتنوع في تجربة واحدة لا تُنسى.'
                            : "From vibrant coral reefs to golden deserts, we take you on a journey that combines Egypt's diverse beauty into one unforgettable experience." }}
                    </p>
                </div>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="/trips"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold text-sm transition">
                        {{ app()->getLocale() === 'ar' ? 'استكشف رحلاتنا' : 'Explore Our Trips' }}
                    </a>
                    <a href="/contact"
                       class="border border-gray-300 hover:border-blue-400 text-gray-700 hover:text-blue-700 px-6 py-3 rounded-xl font-semibold text-sm transition">
                        {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Get in Touch' }}
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-3xl p-10 text-center">
                    <span class="text-9xl block mb-4">🌊</span>
                    <p class="text-blue-700 font-bold text-lg">
                        {{ app()->getLocale() === 'ar' ? 'البحر الأحمر يناديك' : 'The Red Sea is Calling' }}
                    </p>
                    <p class="text-blue-600/70 text-sm mt-1">
                        {{ app()->getLocale() === 'ar' ? 'الغردقة، مصر' : 'Hurghada, Egypt' }}
                    </p>
                </div>
                <div class="absolute -top-4 -right-4 bg-white shadow-lg rounded-2xl px-4 py-3 text-center border border-gray-100">
                    <p class="text-2xl font-extrabold text-blue-700">10K+</p>
                    <p class="text-xs text-gray-500">{{ app()->getLocale() === 'ar' ? 'عميل سعيد' : 'Happy Clients' }}</p>
                </div>
                <div class="absolute -bottom-4 -left-4 bg-white shadow-lg rounded-2xl px-4 py-3 text-center border border-gray-100">
                    <p class="text-2xl font-extrabold text-orange-500">4.9★</p>
                    <p class="text-xs text-gray-500">{{ app()->getLocale() === 'ar' ? 'تقييم العملاء' : 'Client Rating' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="py-20 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">
                {{ app()->getLocale() === 'ar' ? 'مبادئنا' : 'Our Principles' }}
            </p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'ما الذي يميزنا' : 'What Sets Us Apart' }}
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['❤️', app()->getLocale() === 'ar' ? 'الشغف' : 'Passion', app()->getLocale() === 'ar' ? 'نحب ما نفعله وهذا يظهر في كل تفصيل من رحلاتنا' : 'We love what we do, and it shows in every detail of our trips'],
                ['👥', app()->getLocale() === 'ar' ? 'المجتمع' : 'Community', app()->getLocale() === 'ar' ? 'نبني علاقات حقيقية مع عملائنا وشركاء المجتمع المحلي' : 'We build real relationships with our clients and local community partners'],
                ['🌍', app()->getLocale() === 'ar' ? 'الاستدامة' : 'Sustainability', app()->getLocale() === 'ar' ? 'نحمي بيئة البحر الأحمر للأجيال القادمة' : 'We protect the Red Sea environment for future generations'],
                ['🏆', app()->getLocale() === 'ar' ? 'التميز' : 'Excellence', app()->getLocale() === 'ar' ? 'لا نقبل بأقل من الأفضل في كل ما نقدمه' : 'We never settle for less than the best in everything we deliver'],
            ] as [$emoji, $title, $desc])
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition text-center border border-gray-100 hover:border-blue-100">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl">
                        {{ $emoji }}
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="py-20 px-4 bg-gradient-to-r from-blue-700 to-cyan-600">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @foreach([
                ['10,000+', app()->getLocale() === 'ar' ? 'عميل سعيد' : 'Happy Clients'],
                ['50+', app()->getLocale() === 'ar' ? 'رحلة متنوعة' : 'Unique Trips'],
                ['100+', app()->getLocale() === 'ar' ? 'شريك موثوق' : 'Trusted Partners'],
                ['4.9★', app()->getLocale() === 'ar' ? 'متوسط التقييم' : 'Average Rating'],
            ] as [$num, $label])
                <div>
                    <p class="text-4xl font-extrabold text-white mb-2">{{ $num }}</p>
                    <p class="text-blue-100 text-sm">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14">
            <p class="text-blue-600 font-semibold text-sm uppercase tracking-wider mb-2">
                {{ app()->getLocale() === 'ar' ? 'فريقنا' : 'Our Team' }}
            </p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'الأشخاص وراء التجربة' : 'The People Behind the Experience' }}
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach([
                ['👨‍✈️', app()->getLocale() === 'ar' ? 'أحمد العطار' : 'Ahmed Al-Attar',  app()->getLocale() === 'ar' ? 'المؤسس والرئيس التنفيذي' : 'Founder & CEO',        app()->getLocale() === 'ar' ? 'غواص معتمد بخبرة 15 عاماً في البحر الأحمر' : 'Certified diver with 15 years of Red Sea expertise'],
                ['👩‍🏫', app()->getLocale() === 'ar' ? 'سارة محمد' : 'Sara Mohamed',       app()->getLocale() === 'ar' ? 'مديرة العمليات' : 'Operations Manager',           app()->getLocale() === 'ar' ? 'تضمن أن كل رحلة تسير بسلاسة وأمان تام' : 'Ensures every trip runs smoothly and safely'],
                ['👨‍🔬', app()->getLocale() === 'ar' ? 'كريم حسن' : 'Karim Hassan',        app()->getLocale() === 'ar' ? 'كبير المرشدين' : 'Head Guide',                   app()->getLocale() === 'ar' ? 'مرشد سياحي معتمد يتحدث 4 لغات' : 'Certified tour guide speaking 4 languages'],
            ] as [$emoji, $name, $role, $bio])
                <div class="text-center bg-gray-50 rounded-2xl p-8 hover:shadow-md transition border border-gray-100">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                        {{ $emoji }}
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $name }}</h3>
                    <p class="text-blue-600 text-sm font-medium mb-3">{{ $role }}</p>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $bio }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 px-4 bg-gray-900">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
            {{ app()->getLocale() === 'ar' ? 'جاهز لمغامرتك القادمة؟' : 'Ready for Your Next Adventure?' }}
        </h2>
        <p class="text-gray-400 text-base mb-8">
            {{ app()->getLocale() === 'ar'
                ? 'انضم إلى آلاف العملاء السعداء وابدأ رحلتك معنا اليوم'
                : 'Join thousands of happy clients and start your journey with us today' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/trips"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg">
                {{ app()->getLocale() === 'ar' ? 'استكشف الرحلات' : 'Explore Trips' }}
            </a>
            <a href="/contact"
               class="border border-gray-600 hover:border-gray-400 text-gray-300 hover:text-white px-8 py-4 rounded-xl font-semibold transition">
                {{ app()->getLocale() === 'ar' ? 'تحدث مع فريقنا' : 'Talk to Our Team' }}
            </a>
        </div>
    </div>
</section>

@endsection
