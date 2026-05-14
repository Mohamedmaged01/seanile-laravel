<?php
namespace App\Http\Controllers;
use App\Models\Trip;
use App\Models\Destination;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::where('is_active', true)->with('destination');

        if ($request->category) {
            $query->where('category', $request->category);
        }
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $sort = $request->sort ?? 'recommended';
        match($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'rating' => $query->orderByDesc('rating'),
            default => $query->orderBy('sort_order'),
        };

        $trips = $query->paginate(12)->withQueryString();
        $destinations = Destination::where('is_active', true)->get();
        $categories = ['diving', 'safari', 'beach', 'cruise', 'fishing', 'watersports'];

        return view('trips.index', compact('trips', 'destinations', 'categories'));
    }

    public function show(Trip $trip)
    {
        $relatedTrips = Trip::where('category', $trip->category)
            ->where('id', '!=', $trip->id)
            ->where('is_active', true)
            ->take(3)->get();
        return view('trips.show', compact('trip', 'relatedTrips'));
    }
}
