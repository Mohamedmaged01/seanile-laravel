<?php
namespace App\Http\Controllers;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Trip $trip)
    {
        return view('booking.create', compact('trip'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nationality' => 'nullable|string',
            'hotel' => 'nullable|string',
            'trip_date' => 'required|date|after:today',
            'preferred_time' => 'nullable|string',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'infants' => 'nullable|integer|min:0',
            'payment_method' => 'required|string',
            'special_requests' => 'nullable|string',
        ]);

        $trip = Trip::findOrFail($validated['trip_id']);
        $adults = $validated['adults'];
        $children = $validated['children'] ?? 0;
        $infants = $validated['infants'] ?? 0;

        // Calculate extras
        $extras = 0;
        if ($request->vip_transfer) $extras += 30;
        if ($request->private_guide) $extras += 50;
        if ($request->diving_equip) $extras += 25;
        if ($request->photography) $extras += 40;
        if ($request->insurance) $extras += 10;
        if ($request->meals) $extras += 20;

        $subtotal = ($trip->price * $adults) + ($trip->price * 0.5 * $children) + $extras;
        $discount = 0;
        if ($request->promo_code === 'SEANILE10') {
            $discount = $subtotal * 0.10;
        }
        $tax = ($subtotal - $discount) * 0.14;
        $total = $subtotal - $discount + $tax;

        $booking = Booking::create([
            'booking_number' => Booking::generateBookingNumber(),
            'user_id' => auth()->id(),
            'trip_id' => $trip->id,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'nationality' => $validated['nationality'] ?? null,
            'hotel' => $validated['hotel'] ?? null,
            'trip_date' => $validated['trip_date'],
            'preferred_time' => $validated['preferred_time'] ?? null,
            'adults' => $adults,
            'children' => $children,
            'infants' => $infants,
            'vip_transfer' => (bool)$request->vip_transfer,
            'private_guide' => (bool)$request->private_guide,
            'diving_equip' => (bool)$request->diving_equip,
            'photography' => (bool)$request->photography,
            'insurance' => (bool)$request->insurance,
            'meals' => (bool)$request->meals,
            'special_requests' => $validated['special_requests'] ?? null,
            'payment_method' => $validated['payment_method'],
            'currency' => $request->currency ?? 'USD',
            'promo_code' => $request->promo_code,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'total' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.confirmation', $booking);
    }

    public function confirmation(Booking $booking)
    {
        return view('booking.confirmation', compact('booking'));
    }
}
