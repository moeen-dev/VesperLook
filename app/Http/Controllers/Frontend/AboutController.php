<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('frontend.vendors.about', compact('about'));
    }
}
