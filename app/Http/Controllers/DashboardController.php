<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with('trip')->latest()->get();
        $totalSpent = $bookings->where('status', 'completed')->sum('total');
        $upcomingBookings = $bookings->where('status', 'confirmed')->where('trip_date', '>=', now()->toDateString());
        return view('dashboard', compact('user', 'bookings', 'totalSpent', 'upcomingBookings'));
    }
}
