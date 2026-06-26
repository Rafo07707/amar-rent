<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->first();
        $featuredCars = Car::active()->where('is_featured', true)->orderBy('sort_order')->limit(6)->get();
        $locations = Location::active()->orderBy('sort_order')->get();

        return view('home', [
            'page' => $page,
            'featuredCars' => $featuredCars,
            'locations' => $locations,
        ]);
    }
}
