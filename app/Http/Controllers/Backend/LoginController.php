<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('info', 'You are already logged in.');
        }
        
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('info', 'You are already logged in.');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            /** @var \App\Models\Admin $user */
            $user = Auth::guard('admin')->user();

            if ($user->is_admin == 1) {
                $user->update(['is_online' => true]);
                session(['login_time' => now()]);
                return redirect()->route('admin.dashboard');
            } else {
                Auth::guard('admin')->logout();
                return redirect()->route('login')->with('error', 'You are not allowed to access admin panel.');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }


    public function logout()
    {
        $user = Auth::guard('admin')->user();

        if ($user && $user instanceof \App\Models\User) {
            $user->update(['is_online' => false]);
        }

        Auth::guard('admin')->logout();

        session()->forget('login_time');

        return redirect()->route('login');
    }
}
