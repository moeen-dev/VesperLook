<?php

namespace App\Http\Controllers\Frontend;

use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('frontend.vendors.privacy-policy', compact('privacyPolicy'));
    }
}
