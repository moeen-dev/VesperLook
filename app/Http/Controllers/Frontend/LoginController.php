<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPVerificationMail;

class LoginController extends Controller
{
    // Show user login form
    public function showLoginForm()
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.profile')->with('info', 'You are already logged in.');
        }

        return view('frontend.auth.login');
    }

    // User login Validation
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->is_admin == 0) {
                if (!Hash::check($request->password, $user->password)) {
                    return redirect()->route('user.login')->with('error', 'Email and password do not match.');
                }

                if (!$user->email_verified_at) {
                    // Optionally resend the OTP
                    $token = rand(100000, 999999);
                    $user->verification_token = $token;
                    $user->save();

                    Mail::to($user->email)->send(new OTPVerificationMail($token, $user->name));

                    session([
                        'pending_verification_user_id' => $user->id,
                        'otp_expires_at' => now()->addMinute(),
                    ]);

                    return redirect()->route('user.verify.code')->with('warning', 'A verification code has been sent to your email. Please check your inbox and spam folder.');
                }

                // ✅ Now login since email is verified
                Auth::guard('user')->login($user);

                // ✅ Mark user as online
                $user->update(['is_online' => true]);

                $redirect = $request->input('redirect');
                switch ($redirect) {
                    case 'cart':
                        return redirect()->route('cart.index')->with('success', 'You have successfully logged in.');    
                    default:
                        return redirect()->route('user.profile')->with('success', 'You have successfully logged in.');
                }

            } else {
                return redirect()->route('user.login')->with('error', 'You have no permission to login!');
            }
        } else {
            return redirect()->route('user.login')->with('error', 'User not found, Please register!');
        }
    }

    // Show User Register Form
    public function showRegisterForm()
    {
        return view('frontend.auth.register');
    }

    // User Register Validator
    public function register(Request $request)
    {
        // Validation User
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'shipping_address' => 'required|string|max:150',
            'billing_address' => 'required|string|max:150',
        ]);

        $otp = rand(100000, 999999);

        // Creating User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address,
            'password' => Hash::make($request->password),
            'verification_token' => $otp,
            'is_admin' => 0,
        ]);

        Mail::to($user->email)->send(new OTPVerificationMail($otp, $user->name));

        // Store user ID in session
        session([
            'pending_verification_user_id' => $user->id,
            'otp_expires_at' => now()->addMinute()
        ]);

        return redirect()->route('user.verify.code')->with('warning', 'A verification code has been sent to your email. Please check your inbox and spam folder.');;
    }

    // Show Verify code form
    public function showVerifyCode()
    {
        return view('frontend.auth.verify-code');
    }

    // User otp verification
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $userId = session('pending_verification_user_id');
        $expiresAt = session('otp_expires_at');

        if (!$userId || !$expiresAt) {
            return redirect()->route('user.login')->with('error', 'Session expired. Please try again.');
        }

        if (now()->gt($expiresAt)) {
            $user = User::find($userId);

            if ($user) {
                $newOtp = rand(100000, 999999);
                $user->verification_token = $newOtp;
                $user->save();

                Mail::to($user->email)->send(new \App\Mail\OTPVerificationMail($newOtp, $user->name));

                session([
                    'otp_expires_at' => now()->addMinute()
                ]);
            }

            return redirect()->back()->with('error', 'Code expired. A new one has been sent.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('user.register')->with('error', 'User not found.');
        }

        if ($user->verification_token == $request->code) {
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();

            session()->forget('pending_verification_user_id', 'otp_expires_at');

            Auth::guard('user')->login($user);

            // ✅ Mark user as online
            $user->update(['is_online' => true]);

            return redirect()->route('user.profile')->with('success', 'Email verified and you are now logged in!');
        } else {
            return redirect()->back()->with('info', 'Invalid verification code!');
        }
    }

    // User logout
    public function logout()
    {
        $user = Auth::guard('user')->user();

        if ($user && $user instanceof \App\Models\User) {
            $user->update(['is_online' => false]);
        }

        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }
}
