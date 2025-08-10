<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user();

        $num1 = rand(1, 10);
        $num2 = rand(1, 10);

        session([
            'captcha_sum' => $num1 + $num2,
            'captcha_time' => now()
        ]);

        $seo = getSeo('contact');

        return view('frontend.contact.index', compact('user', 'num1', 'num2', 'seo'));
    }

    public function contactSubmit(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name'         => 'required|string|min:5|max:255',
            'email'        => 'required|email|max:255|unique:contacts,email',
            'phone_number' => 'nullable|string|max:20',
            'subject'      => 'required|string|max:255',
            'message'      => 'required|string|max:1000',
            'captcha'      => 'required|numeric',
        ]);

        // Check if captcha expired (after 60 seconds)
        $captchaTime = session('captcha_time');
        if (!$captchaTime || Carbon::parse($captchaTime)->diffInSeconds(now()) > 60) {
            return redirect()->back()->with('error', 'Captcha has expired. Please try again.')->withInput();
        }
        
        // Check captcha
        if ($request->captcha != session('captcha_sum')) {
            return redirect()->back()->with('error', 'Incorrect answer to the captcha question.');
        }

        // Create the contact record in the database
        $input = $request->all();

        // Save message
        Contact::create($input);

        // Send email to the user's email
        Mail::to($request->email)->send(new ContactReceived($request->all()));

        // Clear the captcha from session
        session()->forget('captcha_sum');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
