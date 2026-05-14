@extends('layouts.app')

@section('title', __('messages.blog_title') . ' – SeaNile')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-800 to-cyan-600 py-20 px-4 text-white text-center">
    <h1 class="text-4xl font-bold mb-3">{{ __('messages.blog_title') }}</h1>
    <p class="text-cyan-200 text-lg">Travel tips, guides, and stories from the Red Sea</p>
</section>

<!-- Filters -->
<section class="bg-white border-b py-4 px-4">
    <div class="max-w-7xl mx-auto">
        <form method="GET" action="{{ route('blog.index') }}" class="flex flex-wrap gap-4 items-center">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="{{ __('messages.blog_search') }}"
                   class="border border-gray-300 rounded-xl px-4 py-2 text-sm flex-1 min-w-48 focus:outline-none focus:border-blue-500">
            <select name="category" class="border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                <option value="">{{ __('messages.blog_all_categories') }}</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl text-sm hover:bg-blue-700 transition">Search</button>
            @if(request()->hasAny(['search', 'category']))
            <a href="{{ route('blog.index') }}" class="text-gray-500 text-sm hover:text-red-500">Clear</a>
            @endif
        </form>
    </div>
</section>

<!-- Posts Grid -->
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <div class="h-48 bg-gradient-to-r from-blue-500 to-cyan-400 flex items-center justify-center text-6xl">
                    @if($post->image)
                    <img src="{{ asset($post->image) }}" class="w-full h-full object-cover" alt="">
                    @else
                    📖
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ $post->category }}</span>
                        <span class="text-gray-400 text-xs">{{ $post->read_time }} {{ __('messages.blog_min_read') }}</span>
                    </div>
                    <h2 class="font-bold text-gray-800 text-lg mb-2 line-clamp-2">{{ $post->getLocalizedTitle() }}</h2>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $post->getLocalizedExcerpt() }}</p>
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-400">
                            <span>{{ $post->author }}</span> · <span>{{ $post->published_at?->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 text-sm font-semibold hover:underline">
                            {{ __('messages.blog_read_more') }} →
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
        @else
        <div class="text-center py-20 text-gray-400">
            <p class="text-6xl mb-4">📝</p>
            <p class="text-xl">No blog posts found.</p>
        </div>
        @endif
    </div>
</section>
@endsection
