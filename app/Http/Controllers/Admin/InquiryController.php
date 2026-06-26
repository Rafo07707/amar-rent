<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $inquiries = Booking::inquiries()
            ->with('location')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.inquiries.index', [
            'inquiries' => $inquiries,
            'status' => $status,
        ]);
    }

    public function show(Booking $inquiry)
    {
        abort_unless($inquiry->car_id === null, 404);

        return view('admin.inquiries.show', ['inquiry' => $inquiry->load('location')]);
    }

    public function update(Request $request, Booking $inquiry)
    {
        abort_unless($inquiry->car_id === null, 404);

        $request->validate([
            'status' => 'required|in:new,confirmed,completed,cancelled',
        ]);

        $inquiry->update(['status' => $request->input('status')]);

        return back()->with('success', __('admin.saved'));
    }

    public function destroy(Booking $inquiry)
    {
        abort_unless($inquiry->car_id === null, 404);

        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', __('admin.deleted'));
    }
}
