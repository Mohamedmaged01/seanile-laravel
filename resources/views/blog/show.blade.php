@extends('layouts.app')

@section('title', $blogPost->getLocalizedTitle() . ' – SeaNile Blog')

@section('content')
<article class="py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ route('blog.index') }}" class="hover:text-blue-600">Blog</a>
            <span class="mx-2">/</span>
            <span>{{ $blogPost->category }}</span>
        </div>

        <div class="flex items-center gap-2 mb-4">
            <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">{{ $blogPost->category }}</span>
            <span class="text-gray-400 text-sm">{{ $blogPost->read_time }} min read</span>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $blogPost->getLocalizedTitle() }}</h1>

        <div class="flex items-center gap-3 text-gray-500 text-sm mb-8 pb-8 border-b">
            <span class="font-medium text-gray-700">{{ $blogPost->author }}</span>
            <span>·</span>
            <span>{{ $blogPost->published_at?->format('d M Y') }}</span>
        </div>

        @if($blogPost->image)
        <img src="{{ asset($blogPost->image) }}" alt="{{ $blogPost->getLocalizedTitle() }}" class="w-full h-64 object-cover rounded-2xl mb-8">
        @endif

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! app()->getLocale() === 'ar' && $blogPost->content_ar ? $blogPost->content_ar : $blogPost->content !!}
        </div>

        <div class="mt-12 pt-8 border-t">
            <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline">← Back to Blog</a>
        </div>
    </div>
</article>
@endsection
