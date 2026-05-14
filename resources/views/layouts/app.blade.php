<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SeaNile Tourism – Red Sea Egypt')</title>
    <meta name="description" content="@yield('meta_description', 'Discover Egypt\'s Red Sea Paradise with SeaNile Tourism. Diving, sailing, and adventure experiences in Hurghada.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #0077B6;
            --secondary: #00B4D8;
            --accent: #FF7B00;
        }
        body {
            font-family: {{ app()->getLocale() === 'ar' ? "'Cairo', sans-serif" : "'Inter', sans-serif" }};
        }
        .font-arabic { font-family: 'Cairo', sans-serif; }
        .bg-primary { background-color: #0077B6; }
        .bg-secondary { background-color: #00B4D8; }
        .bg-accent { background-color: #FF7B00; }
        .text-primary { color: #0077B6; }
        .text-secondary { color: #00B4D8; }
        .text-accent { color: #FF7B00; }
        .border-primary { border-color: #0077B6; }
        .hover\:bg-primary:hover { background-color: #005f92; }
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- ========== NAVBAR ========== -->
    <nav x-data="{ mobileOpen: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
         :class="scrolled ? 'bg-white shadow-md' : 'bg-white/95 backdrop-blur-sm'"
         class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 flex-shrink-0">
                    <span class="text-2xl">🌊</span>
                    <span class="text-2xl font-extrabold text-blue-700 tracking-tight">SeaNile</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="/"
                       class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition {{ request()->is('/') ? 'text-blue-700 bg-blue-50' : '' }}">
                        {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                    </a>
                    <a href="/trips"
                       class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition {{ request()->is('trips*') ? 'text-blue-700 bg-blue-50' : '' }}">
                        {{ app()->getLocale() === 'ar' ? 'الرحلات' : 'Trips' }}
                    </a>
                    <a href="/#destinations"
                       class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                        {{ app()->getLocale() === 'ar' ? 'الوجهات' : 'Destinations' }}
                    </a>
                    <a href="/about"
                       class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition {{ request()->is('about') ? 'text-blue-700 bg-blue-50' : '' }}">
                        {{ app()->getLocale() === 'ar' ? 'من نحن' : 'About' }}
                    </a>
                    <a href="/blog"
                       class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition {{ request()->is('blog*') ? 'text-blue-700 bg-blue-50' : '' }}">
                        {{ app()->getLocale() === 'ar' ? 'المدونة' : 'Blog' }}
                    </a>
                    <a href="/contact"
                       class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition {{ request()->is('contact') ? 'text-blue-700 bg-blue-50' : '' }}">
                        {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact' }}
                    </a>
                </div>

                <!-- Right Side: Language + Auth -->
                <div class="hidden lg:flex items-center gap-3">
                    <!-- Language Switcher -->
                    <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-1">
                        <form action="/language/en" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-1 rounded-md text-xs font-semibold transition {{ app()->getLocale() === 'en' ? 'bg-white text-blue-700 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                                EN
                            </button>
                        </form>
                        <form action="/language/ar" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-1 rounded-md text-xs font-semibold transition {{ app()->getLocale() === 'ar' ? 'bg-white text-blue-700 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                                AR
                            </button>
                        </form>
                    </div>

                    <!-- Auth Links -->
                    @auth
                        <a href="/dashboard"
                           class="px-4 py-2 text-sm font-medium text-blue-700 hover:text-blue-800 transition">
                            {{ app()->getLocale() === 'ar' ? 'لوحة التحكم' : 'Dashboard' }}
                        </a>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                {{ app()->getLocale() === 'ar' ? 'تسجيل الخروج' : 'Logout' }}
                            </button>
                        </form>
                    @else
                        <a href="/login"
                           class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-700 transition">
                            {{ app()->getLocale() === 'ar' ? 'تسجيل الدخول' : 'Login' }}
                        </a>
                        <a href="/trips"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm">
                            {{ app()->getLocale() === 'ar' ? 'احجز الآن' : 'Book Now' }}
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger -->
                <button @click="mobileOpen = !mobileOpen"
                        class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition"
                        aria-label="Toggle menu">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-4 space-y-1">
                <a href="/" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                </a>
                <a href="/trips" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                    {{ app()->getLocale() === 'ar' ? 'الرحلات' : 'Trips' }}
                </a>
                <a href="/#destinations" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                    {{ app()->getLocale() === 'ar' ? 'الوجهات' : 'Destinations' }}
                </a>
                <a href="/about" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                    {{ app()->getLocale() === 'ar' ? 'من نحن' : 'About' }}
                </a>
                <a href="/blog" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                    {{ app()->getLocale() === 'ar' ? 'المدونة' : 'Blog' }}
                </a>
                <a href="/contact" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition">
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact' }}
                </a>

                <div class="border-t border-gray-100 pt-3 mt-3 flex items-center gap-2">
                    <form action="/language/en" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ app()->getLocale() === 'en' ? 'bg-blue-700 text-white border-blue-700' : 'text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                            EN
                        </button>
                    </form>
                    <form action="/language/ar" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ app()->getLocale() === 'ar' ? 'bg-blue-700 text-white border-blue-700' : 'text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                            AR
                        </button>
                    </form>
                </div>

                @auth
                    <a href="/dashboard" class="block px-4 py-3 rounded-lg text-sm font-medium text-blue-700 hover:bg-blue-50 transition">
                        {{ app()->getLocale() === 'ar' ? 'لوحة التحكم' : 'Dashboard' }}
                    </a>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                            {{ app()->getLocale() === 'ar' ? 'تسجيل الخروج' : 'Logout' }}
                        </button>
                    </form>
                @else
                    <a href="/login" class="block px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        {{ app()->getLocale() === 'ar' ? 'تسجيل الدخول' : 'Login' }}
                    </a>
                    <a href="/trips" class="block mt-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-xl text-sm font-semibold text-center transition">
                        {{ app()->getLocale() === 'ar' ? 'احجز الآن' : 'Book Now' }}
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div class="h-16 lg:h-20"></div>

    <!-- ========== FLASH MESSAGES ========== -->
    @if(session('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
            <button @click="show = false" class="ml-auto text-white/80 hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
            <button @click="show = false" class="ml-auto text-white/80 hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- ========== MAIN CONTENT ========== -->
    <main>
        @yield('content')
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-10 border-b border-gray-700">

                <!-- Column 1: About SeaNile -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl">🌊</span>
                        <span class="text-xl font-extrabold text-white">SeaNile</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-5">
                        {{ app()->getLocale() === 'ar'
                            ? 'نحن شركة سياحية رائدة في البحر الأحمر، نقدم تجارب غوص وإبحار ومغامرات لا تُنسى في الغردقة، مصر.'
                            : 'Leading Red Sea tourism company offering unforgettable diving, sailing, and adventure experiences in Hurghada, Egypt.' }}
                    </p>
                    <!-- Social Links -->
                    <div class="flex items-center gap-3">
                        <a href="https://facebook.com" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-700 hover:bg-blue-600 rounded-lg flex items-center justify-center transition text-sm font-bold">
                            f
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-700 hover:bg-pink-600 rounded-lg flex items-center justify-center transition text-sm font-bold">
                            in
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-700 hover:bg-sky-500 rounded-lg flex items-center justify-center transition text-sm font-bold">
                            𝕏
                        </a>
                        <a href="https://wa.me/201129338784" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-700 hover:bg-green-600 rounded-lg flex items-center justify-center transition text-sm font-bold">
                            W
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-base font-bold text-white mb-4">
                        {{ app()->getLocale() === 'ar' ? 'روابط سريعة' : 'Quick Links' }}
                    </h3>
                    <ul class="space-y-2">
                        @foreach([
                            ['/',        app()->getLocale() === 'ar' ? 'الرئيسية'     : 'Home'],
                            ['/trips',   app()->getLocale() === 'ar' ? 'الرحلات'      : 'All Trips'],
                            ['/about',   app()->getLocale() === 'ar' ? 'من نحن'       : 'About Us'],
                            ['/blog',    app()->getLocale() === 'ar' ? 'المدونة'      : 'Travel Blog'],
                            ['/contact', app()->getLocale() === 'ar' ? 'اتصل بنا'     : 'Contact Us'],
                            ['/privacy', app()->getLocale() === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy'],
                            ['/terms',   app()->getLocale() === 'ar' ? 'الشروط والأحكام' : 'Terms'],
                        ] as [$href, $label])
                            <li>
                                <a href="{{ $href }}"
                                   class="text-gray-400 hover:text-white text-sm transition flex items-center gap-2">
                                    <span class="text-blue-400">›</span> {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div>
                    <h3 class="text-base font-bold text-white mb-4">
                        {{ app()->getLocale() === 'ar' ? 'معلومات التواصل' : 'Contact Info' }}
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm text-gray-400">
                            <svg class="w-4 h-4 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'الغردقة، البحر الأحمر، مصر' : 'Hurghada, Red Sea, Egypt' }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-400">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:+201129338784" class="hover:text-white transition">+20 112 933 8784</a>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-400">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:info@seanile.com" class="hover:text-white transition">info@seanile.com</a>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-400">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'ar' ? 'يومياً 8 ص – 8 م' : 'Daily 8am – 8pm' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-gray-500">
                <span>© 2024 SeaNile Tourism. All rights reserved.</span>
                <div class="flex items-center gap-4">
                    <a href="/privacy" class="hover:text-gray-300 transition">{{ app()->getLocale() === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy' }}</a>
                    <a href="/terms"   class="hover:text-gray-300 transition">{{ app()->getLocale() === 'ar' ? 'الشروط والأحكام' : 'Terms of Service' }}</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========== WHATSAPP FLOATING BUTTON ========== -->
    <a href="https://wa.me/201129338784"
       target="_blank"
       rel="noopener"
       title="{{ app()->getLocale() === 'ar' ? 'تواصل عبر واتساب' : 'Chat on WhatsApp' }}"
       class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    @stack('scripts')
</body>
</html>
