<?php

namespace App\Http\Controllers\Backend;

use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function privacyPolicyIndex()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('backend.settings.partials.privacy-policy', compact('privacyPolicy'));
    }

    public function privacyPolicyUpdate(Request $request)
    {
        $request->validate([
            'privacy_policy' => 'required',
        ]);

        $input = $request->all();

        $privacyPolicy = PrivacyPolicy::first();

        if ($privacyPolicy) {
            $privacyPolicy->update($input);
        } else {
            $privacyPolicy = PrivacyPolicy::create($input);
        }

        return redirect()->back()->with('success', 'Privacy Policy Updated Successfully.');
    }
}
