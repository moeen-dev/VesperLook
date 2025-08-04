<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Show Blog Page
    public function index()
    {
        return view('frontend.blog.index');
    }

    // Show Blog Details page
    public function blogDetails()
    {
        return view('frontend.blog.details');
    }
}
