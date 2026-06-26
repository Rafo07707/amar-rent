<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $bookings = Booking::bookings()
            ->with(['car', 'location'])
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.bookings.index', [
            'bookings' => $bookings,
            'status' => $status,
        ]);
    }

    public function show(Booking $booking)
    {
        abort_if($booking->car_id === null, 404);

        return view('admin.bookings.show', ['booking' => $booking->load(['car', 'location', 'bookingExtras.extra'])]);
    }

    public function update(Request $request, Booking $booking)
    {
        abort_if($booking->car_id === null, 404);

        $request->validate([
            'status' => 'required|in:new,confirmed,completed,cancelled',
        ]);

        $booking->update(['status' => $request->input('status')]);

        return back()->with('success', __('admin.saved'));
    }

    public function destroy(Booking $booking)
    {
        abort_if($booking->car_id === null, 404);

        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', __('admin.deleted'));
    }
}
