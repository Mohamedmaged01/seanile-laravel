@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'إنشاء حساب – سي نايل' : 'Create Account – SeaNile Tourism')

@section('content')

<section class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-700 flex items-center justify-center px-4 py-16">
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2">
                <span class="text-4xl">🌊</span>
                <span class="text-3xl font-extrabold text-white">SeaNile</span>
            </a>
            <p class="text-blue-200 text-sm mt-2">
                {{ app()->getLocale() === 'ar' ? 'انضم إلى مجتمع مغامري البحر الأحمر' : 'Join our Red Sea adventurers community' }}
            </p>
        </div>

        {{-- Register Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-1">
                {{ app()->getLocale() === 'ar' ? 'إنشاء حساب جديد' : 'Create Account' }}
            </h2>
            <p class="text-gray-500 text-sm mb-7">
                {{ app()->getLocale() === 'ar' ? 'أنشئ حسابك مجاناً وابدأ مغامرتك' : 'Create your free account and start your adventure' }}
            </p>

            {{-- Errors Summary --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5">
                    <p class="text-red-700 font-semibold text-sm mb-1">
                        {{ app()->getLocale() === 'ar' ? 'يرجى تصحيح الأخطاء التالية:' : 'Please fix the following:' }}
                    </p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li class="text-red-600 text-xs">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               autofocus
                               autocomplete="name"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}"
                               class="w-full pl-10 pr-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               autocomplete="username"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'example@email.com' : 'your@email.com' }}"
                               class="w-full pl-10 pr-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Phone (optional) --}}
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                        <span class="text-gray-400 font-normal text-xs">({{ app()->getLocale() === 'ar' ? 'اختياري' : 'optional' }})</span>
                    </label>
                    <div class="relative">
                        <input type="tel"
                               id="phone"
                               name="phone"
                               value="{{ old('phone') }}"
                               placeholder="+20 1XX XXX XXXX"
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ app()->getLocale() === 'ar' ? 'كلمة المرور' : 'Password' }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div x-data="{ showPw: false }" class="relative">
                        <input :type="showPw ? 'text' : 'password'"
                               id="password"
                               name="password"
                               autocomplete="new-password"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'على الأقل 8 أحرف' : 'At least 8 characters' }}"
                               class="w-full pl-10 pr-10 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <button type="button"
                                @click="showPw = !showPw"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg x-show="!showPw" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPw" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div x-data="{ showPw2: false }" class="relative">
                        <input :type="showPw2 ? 'text' : 'password'"
                               id="password_confirmation"
                               name="password_confirmation"
                               autocomplete="new-password"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أعد إدخال كلمة المرور' : 'Re-enter your password' }}"
                               class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <button type="button"
                                @click="showPw2 = !showPw2"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg x-show="!showPw2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPw2" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3">
                    <input type="checkbox" id="terms" name="terms" required
                           class="w-4 h-4 mt-0.5 accent-blue-600 flex-shrink-0">
                    <label for="terms" class="text-xs text-gray-600 leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? 'أوافق على' : 'I agree to the' }}
                        <a href="#" class="text-blue-600 hover:underline font-medium">{{ app()->getLocale() === 'ar' ? 'شروط الخدمة' : 'Terms of Service' }}</a>
                        {{ app()->getLocale() === 'ar' ? 'و' : 'and' }}
                        <a href="#" class="text-blue-600 hover:underline font-medium">{{ app()->getLocale() === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy' }}</a>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-3.5 rounded-xl font-bold text-base transition shadow-md hover:shadow-lg">
                    {{ app()->getLocale() === 'ar' ? 'إنشاء الحساب' : 'Create Account' }}
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-xs text-gray-400">{{ app()->getLocale() === 'ar' ? 'أو' : 'OR' }}</span>
                </div>
            </div>

            {{-- Login Link --}}
            <p class="text-center text-sm text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'لديك حساب بالفعل؟' : 'Already have an account?' }}
                <a href="/login"
                   class="text-blue-600 hover:text-blue-700 font-semibold transition">
                    {{ app()->getLocale() === 'ar' ? 'تسجيل الدخول' : 'Sign In' }}
                </a>
            </p>
        </div>

        {{-- Back to Home --}}
        <div class="text-center mt-6">
            <a href="/" class="text-blue-200 hover:text-white text-sm transition">
                ← {{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
            </a>
        </div>
    </div>
</section>

@endsection
