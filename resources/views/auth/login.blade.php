@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'تسجيل الدخول – سي نايل' : 'Login – SeaNile Tourism')

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
                {{ app()->getLocale() === 'ar' ? 'مرحباً بعودتك! سجل دخولك للمتابعة' : 'Welcome back! Sign in to continue' }}
            </p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-1">
                {{ app()->getLocale() === 'ar' ? 'تسجيل الدخول' : 'Sign In' }}
            </h2>
            <p class="text-gray-500 text-sm mb-7">
                {{ app()->getLocale() === 'ar' ? 'أدخل بيانات حسابك' : 'Enter your account credentials' }}
            </p>

            {{-- Session Status --}}
            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-5">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                    </label>
                    <div class="relative">
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               autofocus
                               autocomplete="username"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email' }}"
                               class="w-full pl-10 pr-4 py-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            {{ app()->getLocale() === 'ar' ? 'كلمة المرور' : 'Password' }}
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-xs text-blue-600 hover:text-blue-700 font-medium transition">
                                {{ app()->getLocale() === 'ar' ? 'نسيت كلمة المرور؟' : 'Forgot password?' }}
                            </a>
                        @endif
                    </div>
                    <div x-data="{ showPw: false }" class="relative">
                        <input :type="showPw ? 'text' : 'password'"
                               id="password"
                               name="password"
                               autocomplete="current-password"
                               placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل كلمة المرور' : 'Enter your password' }}"
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

                {{-- Remember Me --}}
                <div class="flex items-center gap-3">
                    <input type="checkbox"
                           id="remember"
                           name="remember"
                           {{ old('remember') ? 'checked' : '' }}
                           class="w-4 h-4 accent-blue-600 rounded">
                    <label for="remember" class="text-sm text-gray-600 cursor-pointer">
                        {{ app()->getLocale() === 'ar' ? 'تذكرني' : 'Remember me' }}
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl font-bold text-base transition shadow-md hover:shadow-lg">
                    {{ app()->getLocale() === 'ar' ? 'تسجيل الدخول' : 'Sign In' }}
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

            {{-- Register Link --}}
            <p class="text-center text-sm text-gray-600">
                {{ app()->getLocale() === 'ar' ? 'ليس لديك حساب؟' : "Don't have an account?" }}
                <a href="/register"
                   class="text-blue-600 hover:text-blue-700 font-semibold transition">
                    {{ app()->getLocale() === 'ar' ? 'إنشاء حساب' : 'Create Account' }}
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
