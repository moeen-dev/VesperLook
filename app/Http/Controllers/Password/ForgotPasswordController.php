<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('frontend.auth.resetpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            // Redirect to confirmation page with success message
            return redirect()->route('user.login')->with('success', 'Please check your email for further instructions.');
        }

        // If there was an error, return back with error message
        return back()->with(['error' => __($status)]);
    }
}
