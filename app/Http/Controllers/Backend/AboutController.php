<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function aboutIndex()
    {
        $about = About::first();
        return view('backend.settings.partials.about', compact('about'));
    }

    public function aboutUpdate(Request $request)
    {
        $request->validate([
            'about_desc' => 'required',
        ]);

        $input = $request->all();

        $about = About::first();

        if ($about) {
            $about->update($input);
        } else {
            $about = About::create($input);
        }

        return redirect()->back()->with('success', 'About info Updated successfully!');
    }
}
