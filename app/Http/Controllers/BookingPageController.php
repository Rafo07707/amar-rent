<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Extra;
use App\Models\Location;

class BookingPageController extends Controller
{
    public function show()
    {
        $carSlug = request()->query('car');
        $locationSlug = request()->query('location');

        $car = $carSlug ? Car::where('slug', $carSlug)->first() : null;
        $location = $locationSlug ? Location::where('slug', $locationSlug)->first() : null;

        if (!$car) {
            // No car selected: send them to the fleet to pick one first.
            return redirect()->route('fleet', [
                'locale' => app()->getLocale(),
                'location' => $locationSlug,
            ]);
        }

        abort_unless($car->is_active, 404);

        $extras = Extra::active()->get();
        $locations = Location::active()->orderBy('sort_order')->get();

        return view('booking', [
            'car' => $car,
            'selectedLocation' => $location,
            'extras' => $extras,
            'locations' => $locations,
        ]);
    }
}
