<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'ASC')->get();
        return view('backend.order.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('items');
        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail(intval($id))->get();
        return view('backend.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'delivery_status' => 'required|in:pending,processing,shipped,delivered,canceled',
        ]);

        $order = Order::findOrFail($id);

        $order->delivery_status = $request->input('delivery_status');
        $order->save();

        return redirect()->back()->with('success', 'Delivery status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
