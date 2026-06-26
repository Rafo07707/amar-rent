<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    private array $locales = ['hy', 'ru', 'en'];

    public function index()
    {
        $locations = Location::orderBy('sort_order')->get();

        return view('admin.locations.index', ['locations' => $locations]);
    }

    public function create()
    {
        return view('admin.locations.form', ['location' => new Location(), 'locales' => $this->locales]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $location = new Location();
        $this->fillTranslatable($location, $request);
        $location->fill($data);
        $location->slug = $this->makeSlug($request->input('slug'), $request->input('name.en') ?: $request->input('name.hy'));
        $location->save();

        return redirect()->route('admin.locations.index')->with('success', __('admin.saved'));
    }

    public function edit(Location $location)
    {
        return view('admin.locations.form', ['location' => $location, 'locales' => $this->locales]);
    }

    public function update(Request $request, Location $location)
    {
        $data = $this->validateData($request);

        $this->fillTranslatable($location, $request);
        $location->fill($data);
        $location->slug = $this->makeSlug($request->input('slug'), $request->input('name.en') ?: $request->input('name.hy'), $location->id);
        $location->save();

        return redirect()->route('admin.locations.index')->with('success', __('admin.saved'));
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index')->with('success', __('admin.deleted'));
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'icon' => 'nullable|string|max:60',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        return array_merge($validated, [
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active'),
            'icon' => $request->input('icon') ?: 'ti-map-pin',
        ]);
    }

    private function fillTranslatable(Location $location, Request $request): void
    {
        foreach (['name', 'description', 'address', 'working_hours'] as $field) {
            $values = [];
            foreach ($this->locales as $locale) {
                $values[$locale] = $request->input("{$field}.{$locale}", '');
            }
            $location->setTranslations($field, $values);
        }
    }

    private function makeSlug(?string $custom, ?string $fallbackText, ?int $ignoreId = null): string
    {
        $base = Str::slug($custom ?: $fallbackText ?: 'location');
        $slug = $base;
        $i = 1;

        while (Location::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . (++$i);
        }

        return $slug;
    }
}
