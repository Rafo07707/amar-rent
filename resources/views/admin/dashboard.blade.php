<x-admin-layout :title="__('admin.dashboard')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.dashboard') }}</h1>
    <p>{{ __('site.site_name') }}</p>
  </div>
</div>

<div class="stat-grid">
  <div class="stat-card">
    <div class="num">{{ $carsCount }}</div>
    <div class="label">{{ __('admin.total_cars') }}</div>
  </div>
  <div class="stat-card">
    <div class="num">{{ $activeCarsCount }}</div>
    <div class="label">{{ __('admin.active_cars') }}</div>
  </div>
  <div class="stat-card">
    <div class="num">{{ $locationsCount }}</div>
    <div class="label">{{ __('admin.total_locations') }}</div>
  </div>
  <div class="stat-card">
    <div class="num">{{ $newBookingsCount }}</div>
    <div class="label">{{ __('admin.new_bookings') }}</div>
  </div>
  <div class="stat-card">
    <div class="num">{{ $newInquiriesCount }}</div>
    <div class="label">{{ __('admin.inquiries') }}</div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-header" style="margin-bottom:16px;">
    <h1 style="font-size:1.15rem;">{{ __('admin.latest_bookings') }}</h1>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline btn-sm">{{ __('admin.view') }} {{ __('admin.bookings') }}</a>
  </div>
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.booking_number') }}</th>
          <th>{{ __('admin.customer') }}</th>
          <th>{{ __('admin.phone') }}</th>
          <th>{{ __('admin.car') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.created_at') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($latestBookings as $booking)
          <tr onclick="window.location='{{ route('admin.bookings.show', $booking) }}'" style="cursor:pointer;">
            <td>{{ $booking->booking_number }}</td>
            <td>{{ $booking->customer_name }}</td>
            <td>{{ $booking->customer_phone }}</td>
            <td>{{ $booking->car?->name ?? '—' }}</td>
            <td><span class="status-pill status-{{ $booking->status }}">{{ __('admin.booking_status_' . $booking->status) }}</span></td>
            <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
          </tr>
        @empty
          <tr><td colspan="6">{{ __('admin.no_bookings') }}</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</x-admin-layout>
