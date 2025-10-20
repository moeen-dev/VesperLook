<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    // show profile
    public function index()
    {
        $user = Auth::guard('user')->user();
        $orders = Order::where('user_id', $user->id)->latest()->paginate(10);
        return view('frontend.profile.index', compact('user', 'orders'));
    }

    // show profile edit page
    public function editProfile()
    {
        $user = Auth::guard('user')->user();
        return view('frontend.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::guard('user')->user();

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|max:32|confirmed',
            'shipping_address' => 'nullable|string|max:255',
            'billing_address' => 'nullable|string|max:255',
        ]);

        // Update basic info
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->shipping_address = $request->shipping_address ?? $user->shipping_address;
        $user->billing_address = $request->billing_address ?? $user->billing_address;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Update profile image if uploaded
        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('upload/images/' . $user->image))) {
                unlink(public_path('upload/images/' . $user->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $safeUsername = Str::slug($user->name);
            $filename = 'img-' . $safeUsername. '-' . time() . '.' . $extension;
            $file->move('upload/images/', $filename);
            $input['image'] = $filename;
        }

        $user->update(); 

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}
