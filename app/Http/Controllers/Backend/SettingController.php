<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.settings.index');
    }

    
}
