<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        ContactMessage::create($validated);
        return back()->with('success', __('messages.contact_success'));
    }

    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        NewsletterSubscriber::firstOrCreate(['email' => $request->email], ['is_active' => true]);
        return back()->with('newsletter_success', true);
    }
}
