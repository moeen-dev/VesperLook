<?php

namespace App\Http\Controllers\Backend;

use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function generalSettingIndex()
    {
        $setting = GeneralSetting::first();
        return view('backend.settings.general.edit', compact('setting'));
    }

    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'phone_number' => 'nullable|string',
            'email' => 'nullable|email',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'pinterest_url' => 'nullable|url',
        ]);

        $input = $request->all();

        $setting = GeneralSetting::first();

        if ($setting) {
            $setting->update($input);
        } else {
            $setting = GeneralSetting::create($input);
        }

        return redirect()->back()->with('success', 'General Setting Updated Successfully!');

    }
}
