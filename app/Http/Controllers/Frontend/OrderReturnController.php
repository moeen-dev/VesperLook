<?php

namespace App\Http\Controllers\Frontend;

use App\Models\OrderReturn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderReturnController extends Controller
{
    public function index()
    {
        $orderReturn = OrderReturn::first();
        return view('frontend.vendors.order-return', compact('orderReturn'));
    }
}
