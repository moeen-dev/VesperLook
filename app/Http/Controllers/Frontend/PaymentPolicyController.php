<?php

namespace App\Http\Controllers\Frontend;

use App\Models\PaymentPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentPolicyController extends Controller
{
    public function index()
    {
        $paymentPolicy = PaymentPolicy::first();
        return view('frontend.vendors.payment-policy', compact('paymentPolicy'));
    }
}
