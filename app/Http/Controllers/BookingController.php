<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Extra;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:120',
            'customer_phone' => 'required|string|max:30',
            'customer_email' => 'nullable|email|max:120',
            'location_id' => 'nullable|exists:locations,id',
            'car_id' => 'nullable|exists:cars,id',
            'pickup_date' => 'nullable|date',
            'return_date' => 'nullable|date|after_or_equal:pickup_date',
            'extra_ids' => 'nullable|array',
            'extra_ids.*' => 'exists:extras,id',
            'payment_method' => 'nullable|in:pay_on_arrival,crypto,ameria_bank',
            'crypto_txid' => 'nullable|string|max:200',
            'additional_driver' => 'nullable|boolean',
            'child_seat' => 'nullable|boolean',
            'gps' => 'nullable|boolean',
            'notes' => 'nullable|string|max:2000',
        ]);

        $extraIds = $validated['extra_ids'] ?? [];
        unset($validated['extra_ids']);

        $validated['booking_number'] = Booking::generateBookingNumber();
        $validated['locale'] = app()->getLocale();
        $validated['status'] = 'new';

        $days = 1;
        if (!empty($validated['pickup_date']) && !empty($validated['return_date'])) {
            $days = max(1, (int) \Carbon\Carbon::parse($validated['pickup_date'])
                ->diffInDays(\Carbon\Carbon::parse($validated['return_date'])));
        }

        $total = 0;
        if (!empty($validated['car_id'])) {
            $car = Car::find($validated['car_id']);
            if ($car) {
                $total += (float) $car->price_per_day * $days;
            }
        }

        $extras = Extra::whereIn('id', $extraIds)->get();
        foreach ($extras as $extra) {
            $total += $extra->priceForDays($days);
        }

        $validated['total_amount'] = $total > 0 ? $total : null;

        $booking = Booking::create($validated);

        foreach ($extras as $extra) {
            $booking->bookingExtras()->create([
                'extra_id' => $extra->id,
                'price_at_booking' => $extra->priceForDays($days),
            ]);
        }

        return back()->with('success', __('messages.booking_success'));
    }
}
