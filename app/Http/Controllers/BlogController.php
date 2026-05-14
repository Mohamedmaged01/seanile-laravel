<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::where('is_published', true)->orderByDesc('published_at');
        if ($request->category) {
            $query->where('category', $request->category);
        }
        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }
        $posts = $query->paginate(9)->withQueryString();
        $categories = BlogPost::where('is_published', true)->distinct()->pluck('category')->filter()->values();
        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(BlogPost $blogPost)
    {
        abort_unless($blogPost->is_published, 404);
        return view('blog.show', compact('blogPost'));
    }
}
