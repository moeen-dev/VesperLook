<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::OrderBy('id', 'DESC')->paginate(10);
        return view('backend.settings.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.settings.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'faq_question' => 'required|string',
            'faq_answer' => 'required',
        ]);

        $input = $request->all();

        $faq = Faq::create($input);

        if ($faq) {
            return redirect()->route('admin.setting.faq.index')->with('success', 'Faq Added Successfully.');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::findOrFail(intval($id));

        return view('backend.settings.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        if ($faq->id == $request->id) {
            $request->validate([
                'faq_question' => 'required|string',
                'faq_answer' => 'required',
            ]);
        } else {
            $request->validate([
                'faq_question' => 'required|string|unique:faqs,faq_question',
                'faq_answer' => 'required',
            ]);
        }

        $input = $request->all();

        $faqUpdate = $faq->update($input);

        if ($faqUpdate) {
            return redirect()->route('admin.setting.faq.index')->with('success', 'FAQ Updated Successfully.');
        }

        return redirect()->back()->with('error', 'Please Try Again, Something Went Wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail(intval($id));

        if ($faq->count >= 0) {
            return redirect()->route('admin.setting.faq.index')->with('error', 'You Can not Delete this FAQ, You have left only three faq.');
        } else {
            $faq->delete();
        }

        return redirect()->back()->with('success', 'FAQ Deleted Successfully.');
    }
}
