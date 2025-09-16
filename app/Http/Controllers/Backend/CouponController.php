<?php

namespace App\Http\Controllers\Backend;

use App\Models\Discount;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::orderBy('id', 'ASC')->get();
        return view('backend.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:discounts,code',
            'min_order_amount' => 'required|numeric|min:0',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'expires_at' => 'required|date|after:now',
        ]);

        Discount::create([
            'code' => $request->code,
            'min_order_amount' => $request->min_order_amount,
            'discount_percent' => $request->discount_percent,
            'expires_at' => Carbon::parse($request->expires_at),
        ]);

        return redirect()->route('coupon.index')->with('success', 'Discount coupon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = Discount::findOrFail(intval($id));

        $discount->delete();

        return redirect()->back()->with('success', 'Discount Coupon Deleted Successfully.');
    }
}
