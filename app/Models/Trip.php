<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = [
        'destination_id', 'title', 'title_ar', 'description', 'description_ar',
        'category', 'price', 'original_price', 'rating', 'reviews_count',
        'duration', 'duration_hours', 'min_people', 'max_people', 'badge',
        'includes_food', 'includes_insurance', 'includes_pickup',
        'highlights', 'image', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'highlights' => 'array',
        'includes_food' => 'boolean',
        'includes_insurance' => 'boolean',
        'includes_pickup' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getLocalizedTitle(): string
    {
        return app()->getLocale() === 'ar' && $this->title_ar ? $this->title_ar : $this->title;
    }

    public function getLocalizedDescription(): ?string
    {
        return app()->getLocale() === 'ar' && $this->description_ar ? $this->description_ar : $this->description;
    }

    public function getSavingPercentage(): ?int
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return null;
    }
}
