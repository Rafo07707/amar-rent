<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExtraController extends Controller
{
    private array $locales = ['hy', 'ru', 'en'];

    public function index()
    {
        $extras = Extra::orderBy('sort_order')->get();

        return view('admin.extras.index', ['extras' => $extras]);
    }

    public function create()
    {
        return view('admin.extras.form', ['extra' => new Extra(), 'locales' => $this->locales]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $extra = new Extra();
        $this->fillTranslatable($extra, $request);
        $extra->fill($data);
        $extra->key = $this->makeKey($request->input('key'), $request->input('name.en') ?: $request->input('name.hy'));
        $extra->save();

        return redirect()->route('admin.extras.index')->with('success', __('admin.saved'));
    }

    public function edit(Extra $extra)
    {
        return view('admin.extras.form', ['extra' => $extra, 'locales' => $this->locales]);
    }

    public function update(Request $request, Extra $extra)
    {
        $data = $this->validateData($request);

        $this->fillTranslatable($extra, $request);
        $extra->fill($data);
        $extra->key = $this->makeKey($request->input('key'), $request->input('name.en') ?: $request->input('name.hy'), $extra->id);
        $extra->save();

        return redirect()->route('admin.extras.index')->with('success', __('admin.saved'));
    }

    public function destroy(Extra $extra)
    {
        $extra->delete();

        return redirect()->route('admin.extras.index')->with('success', __('admin.deleted'));
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'icon' => 'nullable|string|max:60',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:8',
            'pricing_type' => 'required|in:flat,per_day',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        return array_merge($validated, [
            'currency' => $request->input('currency') ?: 'AMD',
            'icon' => $request->input('icon') ?: 'ti-plus',
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active'),
        ]);
    }

    private function fillTranslatable(Extra $extra, Request $request): void
    {
        foreach (['name', 'description'] as $field) {
            $values = [];
            foreach ($this->locales as $locale) {
                $values[$locale] = $request->input("{$field}.{$locale}", '');
            }
            $extra->setTranslations($field, $values);
        }
    }

    private function makeKey(?string $custom, ?string $fallbackText, ?int $ignoreId = null): string
    {
        $base = Str::slug($custom ?: $fallbackText ?: 'extra', '_');
        $key = $base;
        $i = 1;

        while (Extra::where('key', $key)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $key = $base . '_' . (++$i);
        }

        return $key;
    }
}
