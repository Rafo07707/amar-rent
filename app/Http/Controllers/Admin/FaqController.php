<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    private array $locales = ['hy', 'ru', 'en'];

    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();

        return view('admin.faqs.index', ['faqs' => $faqs]);
    }

    public function create()
    {
        return view('admin.faqs.form', ['faq' => new Faq(), 'locales' => $this->locales]);
    }

    public function store(Request $request)
    {
        $faq = new Faq();
        $this->fillTranslatable($faq, $request);
        $faq->sort_order = $request->input('sort_order', 0);
        $faq->is_active = $request->boolean('is_active');
        $faq->save();

        return redirect()->route('admin.faqs.index')->with('success', __('admin.saved'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', ['faq' => $faq, 'locales' => $this->locales]);
    }

    public function update(Request $request, Faq $faq)
    {
        $this->fillTranslatable($faq, $request);
        $faq->sort_order = $request->input('sort_order', 0);
        $faq->is_active = $request->boolean('is_active');
        $faq->save();

        return redirect()->route('admin.faqs.index')->with('success', __('admin.saved'));
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', __('admin.deleted'));
    }

    private function fillTranslatable(Faq $faq, Request $request): void
    {
        foreach (['question', 'answer'] as $field) {
            $values = [];
            foreach ($this->locales as $locale) {
                $values[$locale] = $request->input("{$field}.{$locale}", '');
            }
            $faq->setTranslations($field, $values);
        }
    }
}
