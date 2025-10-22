<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\NewsletterSubscriber;
use App\Mail\NewsletterWelcomeMail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|email',
        ]);

        $email = $request->email;
        $ip = $request->ip();

        // Check if this email is already subscribed
        if (NewsletterSubscriber::where('email', $email)->exists()) {
            return back()->with('error', 'This email is already subscribed.');
        }

        // Check if this IP already subscribed in the last 7 days
        $oneWeekAgo = Carbon::now()->subDays(7);
        $existingIp = NewsletterSubscriber::where('ip_address', $ip)
            ->where('created_at', '>=', $oneWeekAgo)
            ->exists();

        if ($existingIp) {
            return back()->with('error', 'Subscription limit reached for this IP. Try again after a week.');
        }
        // Create new subscriber
        $subscriber = NewsletterSubscriber::create([
            'email' => $email,
            'ip_address' => $ip,
        ]);

        Mail::to($subscriber->email)->send(new NewsletterWelcomeMail($subscriber));

        // Set cookie for 1 year (525600 minutes)
        $cookie = cookie('hide_newsletter_popup', true, 525600);

        return back()->with('success', 'Subscribed successfully!')->cookie($cookie);
    }


    public function hidePopup(Request $request)
    {
        // Set cookie for 60 minutes
        $cookie = cookie('hide_newsletter_popup', true, 60);
        return response()->json(['status' => 'ok'])->cookie($cookie);
    }
}
