<?php

namespace App\Http\Controllers\Backend;

use App\Models\OrderReturn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderReturnController extends Controller
{
    public function orderReturnIndex()
    {
        $orderReturn = OrderReturn::first();
        return view('backend.settings.partials.order-return', compact('orderReturn'));
    }

    public function orderReturnUpdate(Request $request)
    {
        $request->validate([
            'order_returns' => 'required',
        ]);

        $input = $request->all();

        $orderReturn = OrderReturn::first();

        if ($orderReturn) {
            $orderReturn->update($input);
        } else {
            $orderReturn = OrderReturn::create($input);
        }

        return redirect()->back()->with('success', 'Order return Updated successfully!');
    }
}
