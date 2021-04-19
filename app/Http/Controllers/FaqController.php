<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('front.home.faq', compact('faqs'));
    }
    public function manage()
    {
        $faqs = Faq::all();
        return view('portal.faq.index', compact('faqs'));
    }
    public function add() {
        return view('portal.faq.add');
    }

    public function store(Request $req) {
        // dd($req->all());
        $faq = new Faq;
        $faq->question = $req->question;
        $faq->answer = $req->answer;
        $faq->save();
        return redirect()->route('admin.faq');
    }

    public function edit($faqId) {
        $faq = Faq::find(decrypt($faqId));
        return view('portal.faq.edit', compact('faq'));
    }

    public function update(Request $req) {
        $faq = Faq::find($req->faqId);
        $faq->question = $req->question;
        $faq->answer = $req->answer;
        $faq->save();
        return redirect()->route('admin.faq');
    }

    public function delete($faqId) {
        $faq = Faq::find(decrypt($faqId));
        $faq->delete();
        return redirect()->route('admin.faq');
    }
}
