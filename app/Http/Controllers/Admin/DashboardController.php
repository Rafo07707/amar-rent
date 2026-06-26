<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'carsCount' => Car::count(),
            'activeCarsCount' => Car::active()->count(),
            'locationsCount' => Location::count(),
            'newBookingsCount' => Booking::bookings()->where('status', 'new')->count(),
            'totalBookingsCount' => Booking::bookings()->count(),
            'newInquiriesCount' => Booking::inquiries()->where('status', 'new')->count(),
            'latestBookings' => Booking::bookings()->with(['car', 'location'])->latest()->limit(8)->get(),
        ]);
    }
}
