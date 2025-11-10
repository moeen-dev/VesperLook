<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\OrderReturn;
use App\Models\PrivacyPolicy;
use App\Models\PaymentPolicy;
use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    // To show about us pages
    public function about()
    {
        $about = About::first();
        $seo = getSeo('aboutus');
        return view('frontend.vendors.about', compact('about', 'seo'));
    }

    // To show Frequently Asked Question's
    // public function faq()
    // {
    //     $faqs = Faq::orderBy('id', 'ASC')->get();
    //     return view('frontend.vendors.faq', compact('faqs'));
    // }

    // To show Order Return policy page
    public function orderReturn()
    {
        $orderReturn = OrderReturn::first();
        $seo = getSeo('orderandreturns');
        return view('frontend.vendors.order-return', compact('orderReturn', 'seo'));
    }

    // To show Privacy Policy page
    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();
        $seo = getSeo('privacy');
        return view('frontend.vendors.privacy-policy', compact('privacyPolicy', 'seo'));
    }

    // To show Payment Policy page
    public function paymentPolicy()
    {
        $paymentPolicy = PaymentPolicy::first();
        $seo = getSeo('paymentpolicy');
        return view('frontend.vendors.payment-policy', compact('paymentPolicy', 'seo'));
    }
}
