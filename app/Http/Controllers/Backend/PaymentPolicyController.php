<?php

namespace App\Http\Controllers\Backend;

use App\Models\PaymentPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentPolicyController extends Controller
{
    public function paymentPolicyIndex()
    {
        $paymentPolicy = PaymentPolicy::first();
        return view('backend.settings.partials.payment-policy', compact('paymentPolicy'));
    }

    public function paymentPolicyUpdate(Request $request)
    {
        $request->validate([
            'payment_policy' => 'required',
        ]);

        $input = $request->all();

        $paymentPolicy = PaymentPolicy::first();

        if ($paymentPolicy) {
            $paymentPolicy->update($input);
        } else {
            $paymentPolicy = PaymentPolicy::create($input);
        }

        return redirect()->back()->with('success', 'Payment Policy Updated Successfully.');
    }
}
