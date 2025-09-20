<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDO;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'is_admin' => 'required|in:0,1',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
            'email_verified_at' => now(),
        ]);

        $message = $user->is_admin ? 'Admin created successfully!' : 'User created successfully!';

        return redirect()->route('users.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail(intval($id));

        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail(intval($id));

        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->email == $request->email) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'is_admin' => 'required|in:0,1',
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'is_admin' => 'required|in:0,1',
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8'
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
