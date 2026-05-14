<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'booking_number', 'user_id', 'trip_id',
        'full_name', 'email', 'phone', 'nationality', 'hotel',
        'trip_date', 'preferred_time', 'adults', 'children', 'infants',
        'vip_transfer', 'private_guide', 'diving_equip', 'photography',
        'insurance', 'meals', 'special_requests',
        'payment_method', 'currency', 'promo_code',
        'subtotal', 'discount', 'tax', 'total',
        'status', 'notes',
    ];

    protected $casts = [
        'trip_date' => 'date',
        'vip_transfer' => 'boolean',
        'private_guide' => 'boolean',
        'diving_equip' => 'boolean',
        'photography' => 'boolean',
        'insurance' => 'boolean',
        'meals' => 'boolean',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public static function generateBookingNumber(): string
    {
        return 'BK-' . strtoupper(substr(uniqid(), -5));
    }

    public function getTotalPeopleAttribute(): int
    {
        return $this->adults + $this->children + $this->infants;
    }
}
