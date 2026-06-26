<x-admin-layout :title="__('admin.bookings')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.bookings') }}</h1>
  </div>
</div>

<div class="toolbar">
  <div class="filter-pills">
    <a href="{{ route('admin.bookings.index') }}" class="filter-pill {{ !$status ? 'active' : '' }}">{{ __('admin.all_statuses') }}</a>
    @foreach (['new', 'confirmed', 'completed', 'cancelled'] as $s)
      <a href="{{ route('admin.bookings.index', ['status' => $s]) }}" class="filter-pill {{ $status === $s ? 'active' : '' }}">{{ __('admin.booking_status_' . $s) }}</a>
    @endforeach
  </div>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.booking_number') }}</th>
          <th>{{ __('admin.customer') }}</th>
          <th>{{ __('admin.phone') }}</th>
          <th>{{ __('admin.car') }}</th>
          <th>{{ __('admin.dates') }}</th>
          <th>{{ __('admin.payment_method') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.created_at') }}</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($bookings as $booking)
          <tr>
            <td>{{ $booking->booking_number }}</td>
            <td>{{ $booking->customer_name }}</td>
            <td>{{ $booking->customer_phone }}</td>
            <td>{{ $booking->car?->name ?? '—' }}</td>
            <td>
              @if ($booking->pickup_date)
                {{ $booking->pickup_date->format('Y-m-d') }} → {{ $booking->return_date?->format('Y-m-d') }}
              @else
                —
              @endif
            </td>
            <td>
              @if ($booking->payment_method === 'crypto')
                <span class="tag" style="background:#FEF3E7; color:#C9622B;">
                  <i class="ti ti-currency-bitcoin"></i> Crypto
                  @if (!$booking->crypto_txid)<i class="ti ti-clock" title="{{ __('admin.crypto_txid_pending') }}"></i>@endif
                </span>
              @elseif ($booking->payment_method === 'ameria_bank')
                <span class="tag"><i class="ti ti-building-bank"></i> Ameria</span>
              @else
                <span class="tag"><i class="ti ti-clock"></i> {{ __('site.pay_on_arrival') }}</span>
              @endif
            </td>
            <td><span class="status-pill status-{{ $booking->status }}">{{ __('admin.booking_status_' . $booking->status) }}</span></td>
            <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
            <td class="actions-cell">
              <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-outline btn-sm"><i class="ti ti-eye"></i></a>
              <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="8">{{ __('admin.no_bookings') }}</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="pagination-wrap">{{ $bookings->links() }}</div>

</x-admin-layout>
