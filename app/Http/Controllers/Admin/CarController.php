<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarController extends Controller
{
    private array $locales = ['hy', 'ru', 'en'];

    public function index()
    {
        $cars = Car::orderBy('sort_order')->orderBy('id', 'desc')->paginate(15);

        return view('admin.cars.index', ['cars' => $cars]);
    }

    public function create()
    {
        return view('admin.cars.form', [
            'car' => new Car(),
            'locales' => $this->locales,
            'locations' => Location::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $car = new Car();
        $this->fillTranslatable($car, $request);
        $car->fill($data);
        $car->slug = $this->makeSlug($request->input('slug'), $request->input('name.en') ?: $request->input('name.hy'));

        if ($request->hasFile('image')) {
            $car->image = $request->file('image')->store('cars', 'public');
        }

        $car->save();
        $car->locations()->sync($request->input('location_ids', []));

        return redirect()->route('admin.cars.index')->with('success', __('admin.saved'));
    }

    public function edit(Car $car)
    {
        return view('admin.cars.form', [
            'car' => $car,
            'locales' => $this->locales,
            'locations' => Location::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Car $car)
    {
        $data = $this->validateData($request);

        $this->fillTranslatable($car, $request);
        $car->fill($data);
        $car->slug = $this->makeSlug($request->input('slug'), $request->input('name.en') ?: $request->input('name.hy'), $car->id);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $car->image = $request->file('image')->store('cars', 'public');
        }

        $car->save();
        $car->locations()->sync($request->input('location_ids', []));

        return redirect()->route('admin.cars.index')->with('success', __('admin.saved'));
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', __('admin.deleted'));
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'category' => 'required|in:compact,sedan,suv,premium',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:petrol,diesel,hybrid,electric',
            'seats' => 'required|integer|min:1|max:9',
            'bags' => 'nullable|integer|min:0|max:9',
            'price_per_day' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'included_km_per_day' => 'nullable|integer|min:0',
            'currency' => 'nullable|string|max:8',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|max:4096',
            'location_ids' => 'nullable|array',
            'location_ids.*' => 'exists:locations,id',
        ]);

        return array_merge(array_diff_key($validated, ['image' => null, 'location_ids' => null]), [
            'currency' => $request->input('currency') ?: 'AMD',
            'bags' => $request->input('bags', 2),
            'deposit_amount' => $request->input('deposit_amount', 0),
            'included_km_per_day' => $request->input('included_km_per_day', 0),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
        ]);
    }

    private function fillTranslatable(Car $car, Request $request): void
    {
        foreach (['name', 'description'] as $field) {
            $values = [];
            foreach ($this->locales as $locale) {
                $values[$locale] = $request->input("{$field}.{$locale}", '');
            }
            $car->setTranslations($field, $values);
        }
    }

    private function makeSlug(?string $custom, ?string $fallbackText, ?int $ignoreId = null): string
    {
        $base = Str::slug($custom ?: $fallbackText ?: 'car');
        $slug = $base;
        $i = 1;

        while (Car::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . (++$i);
        }

        return $slug;
    }
}
