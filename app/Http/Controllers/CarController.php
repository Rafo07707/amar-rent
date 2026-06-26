<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');
        $locationSlug = $request->query('location');

        $cars = Car::active()
            ->ofCategory($category)
            ->atLocation($locationSlug)
            ->orderBy('sort_order')
            ->get();

        $selectedLocation = $locationSlug
            ? \App\Models\Location::where('slug', $locationSlug)->first()
            : null;

        return view('fleet', [
            'cars' => $cars,
            'category' => $category,
            'selectedLocation' => $selectedLocation,
        ]);
    }

    public function show(Car $car)
    {
        abort_unless($car->is_active, 404);

        $related = Car::active()
            ->where('category', $car->category)
            ->where('id', '!=', $car->id)
            ->limit(3)
            ->get();

        return view('car', [
            'car' => $car,
            'related' => $related,
        ]);
    }
}
