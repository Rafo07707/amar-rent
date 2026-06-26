<x-admin-layout :title="$booking->booking_number">

<div class="admin-header">
  <div>
    <h1>{{ $booking->booking_number }}</h1>
    <p>{{ $booking->created_at->format('Y-m-d H:i') }}</p>
  </div>
  <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<div class="form-grid">
  <div class="admin-card">
    <h3 style="margin-bottom:16px; font-size:1rem;">{{ __('admin.customer') }}</h3>
    <p><strong>{{ __('admin.customer') }}:</strong> {{ $booking->customer_name }}</p>
    <p><strong>{{ __('admin.phone') }}:</strong> {{ $booking->customer_phone }}</p>
    <p><strong>{{ __('site.email_label') }}:</strong> {{ $booking->customer_email ?: '—' }}</p>

    <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.dates') }}</h3>
    <p><strong>{{ __('site.form_pickup_date') }}:</strong> {{ $booking->pickup_date?->format('Y-m-d') ?: '—' }}</p>
    <p><strong>{{ __('site.form_return_date') }}:</strong> {{ $booking->return_date?->format('Y-m-d') ?: '—' }}</p>

    <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.car') }} / {{ __('admin.locations') }}</h3>
    <p><strong>{{ __('admin.car') }}:</strong> {{ $booking->car?->name ?? '—' }}</p>
    <p><strong>{{ __('admin.locations') }}:</strong> {{ $booking->location?->name ?? '—' }}</p>

    <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.extras') }}</h3>
    @forelse ($booking->bookingExtras as $bookingExtra)
      <p><strong><i class="{{ $bookingExtra->extra->icon }}"></i> {{ $bookingExtra->extra->name }}:</strong> {{ number_format($bookingExtra->price_at_booking, 0) }} {{ $bookingExtra->extra->currency }}</p>
    @empty
      <p>—</p>
    @endforelse

    @if ($booking->total_amount)
      <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.total_amount') }}</h3>
      <p style="font-size:1.3rem; font-weight:700; color:var(--pine-2);">{{ number_format($booking->total_amount, 0) }} {{ $booking->car?->currency ?? 'AMD' }}</p>
    @endif

    <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.payment_method') }}</h3>
    @if ($booking->payment_method === 'crypto')
      <p>
        <span class="tag" style="background:#FEF3E7; color:#C9622B; border:1px solid #F7C994;">
          <i class="ti ti-currency-bitcoin"></i> Crypto
        </span>
      </p>
      @if ($booking->crypto_txid)
        <p style="margin-top:8px;"><strong>{{ __('admin.crypto_txid') }}:</strong></p>
        <code style="font-size:0.82rem; word-break:break-all; color:var(--pine-2);">{{ $booking->crypto_txid }}</code>
        <p class="form-hint" style="margin-top:4px;">{{ __('admin.crypto_verify_hint') }}</p>
      @else
        <p class="form-hint" style="color:var(--rust);">{{ __('admin.crypto_txid_pending') }}</p>
      @endif
    @elseif ($booking->payment_method === 'ameria_bank')
      <p><span class="tag"><i class="ti ti-building-bank"></i> Ameriabank</span></p>
    @else
      <p><span class="tag"><i class="ti ti-clock"></i> {{ __('site.pay_on_arrival') }}</span></p>
    @endif

    @if ($booking->notes)
      <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.notes') }}</h3>
      <p>{{ $booking->notes }}</p>
    @endif
  </div>

  <div class="admin-card" style="align-self:start;">
    <h3 style="margin-bottom:16px; font-size:1rem;">{{ __('admin.status') }}</h3>
    @if ($booking->payment_method === 'crypto' && $booking->crypto_txid)
      <div class="admin-alert admin-alert-success" style="margin-bottom:16px; font-size:0.88rem;">
        <i class="ti ti-info-circle"></i> {{ __('admin.crypto_confirm_note') }}
      </div>
    @endif
    <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <select name="status">
          @foreach (['new', 'confirmed', 'completed', 'cancelled'] as $s)
            <option value="{{ $s }}" {{ $booking->status === $s ? 'selected' : '' }}>{{ __('admin.booking_status_' . $s) }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">{{ __('admin.save') }}</button>
    </form>
  </div>
</div>

</x-admin-layout>
