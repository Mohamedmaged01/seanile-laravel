<?php
namespace App\Http\Controllers;
use App\Models\Trip;
use App\Models\Destination;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredTrips = Trip::where('is_featured', true)->where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $destinations = Destination::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->take(6)->get();
        return view('home', compact('featuredTrips', 'destinations', 'testimonials'));
    }
}
