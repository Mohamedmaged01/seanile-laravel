<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'title_ar', 'slug', 'excerpt', 'excerpt_ar',
        'content', 'content_ar', 'author', 'category', 'image',
        'read_time', 'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getLocalizedTitle(): string
    {
        return app()->getLocale() === 'ar' && $this->title_ar ? $this->title_ar : $this->title;
    }

    public function getLocalizedExcerpt(): ?string
    {
        return app()->getLocale() === 'ar' && $this->excerpt_ar ? $this->excerpt_ar : $this->excerpt;
    }
}
