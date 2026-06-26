<x-admin-layout :title="$inquiry->customer_name">

<div class="admin-header">
  <div>
    <h1>{{ $inquiry->customer_name }}</h1>
    <p>{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
  </div>
  <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<div class="form-grid">
  <div class="admin-card">
    <h3 style="margin-bottom:16px; font-size:1rem;">{{ __('admin.customer') }}</h3>
    <p><strong>{{ __('admin.customer') }}:</strong> {{ $inquiry->customer_name }}</p>
    <p><strong>{{ __('admin.phone') }}:</strong> {{ $inquiry->customer_phone }}</p>
    <p><strong>{{ __('site.email_label') }}:</strong> {{ $inquiry->customer_email ?: '—' }}</p>
    <p><strong>{{ __('admin.locations') }}:</strong> {{ $inquiry->location?->name ?? '—' }}</p>

    @if ($inquiry->notes)
      <h3 style="margin:20px 0 12px; font-size:1rem;">{{ __('admin.notes') }}</h3>
      <p>{{ $inquiry->notes }}</p>
    @endif
  </div>

  <div class="admin-card" style="align-self:start;">
    <h3 style="margin-bottom:16px; font-size:1rem;">{{ __('admin.status') }}</h3>
    <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <select name="status">
          @foreach (['new', 'confirmed', 'completed', 'cancelled'] as $s)
            <option value="{{ $s }}" {{ $inquiry->status === $s ? 'selected' : '' }}>{{ __('admin.booking_status_' . $s) }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">{{ __('admin.save') }}</button>
    </form>
  </div>
</div>

</x-admin-layout>
