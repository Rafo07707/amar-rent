<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'page' => Page::where('slug', 'about')->first(),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'page' => Page::where('slug', 'services')->first(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'page' => Page::where('slug', 'contact')->first(),
        ]);
    }

    public function privacy()
    {
        return view('pages.legal', [
            'page' => Page::where('slug', 'privacy')->first(),
        ]);
    }

    public function terms()
    {
        return view('pages.legal', [
            'page' => Page::where('slug', 'terms')->first(),
        ]);
    }

    public function faq()
    {
        return view('pages.faq', [
            'page' => Page::where('slug', 'faq')->first(),
            'faqs' => Faq::active()->get(),
        ]);
    }
}
