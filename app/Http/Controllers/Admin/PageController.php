<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private array $locales = ['hy', 'ru', 'en'];

    public function index()
    {
        $pages = Page::orderBy('slug')->get();

        return view('admin.pages.index', ['pages' => $pages]);
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', ['page' => $page, 'locales' => $this->locales]);
    }

    public function update(Request $request, Page $page)
    {
        foreach (['title', 'content', 'meta_title', 'meta_description'] as $field) {
            $values = [];
            foreach ($this->locales as $locale) {
                $values[$locale] = $request->input("{$field}.{$locale}", '');
            }
            $page->setTranslations($field, $values);
        }

        $page->save();

        return redirect()->route('admin.pages.index')->with('success', __('admin.saved'));
    }
}
