<?php

namespace App\Http\Controllers;

use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::active()->orderBy('sort_order')->get();

        return view('locations', [
            'locations' => $locations,
        ]);
    }

    public function show($locale, Location $location)
    {
        abort_unless($location->is_active, 404);

        return view('location', [
            'location' => $location,
        ]);
    }
}
