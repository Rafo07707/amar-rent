<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Plain contact-form inquiry. Stored as a Booking (so it shows up in the
     * same admin Bookings list) but without a car, dates, or extras attached.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:120',
            'customer_phone' => 'required|string|max:30',
            'customer_email' => 'nullable|email|max:120',
            'location_id' => 'nullable|exists:locations,id',
            'notes' => 'nullable|string|max:2000',
        ]);

        $validated['booking_number'] = Booking::generateBookingNumber();
        $validated['locale'] = app()->getLocale();
        $validated['status'] = 'new';

        Booking::create($validated);

        return back()->with('success', __('messages.booking_success'));
    }
}
