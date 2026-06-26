@php
  $locale = app()->getLocale();
  $whatsapp = \App\Models\Setting::get('site_whatsapp', '37433123456');
@endphp
<x-layout
  :meta-title="__('site.booking_title') . ' — ' . $car->name . ' | Amar Rent Car Armenia'"
  :meta-description="__('site.booking_subtitle')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb">
      <a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> /
      <a href="{{ route('fleet', ['locale' => $locale]) }}">{{ __('site.nav_fleet') }}</a> /
      <span>{{ __('site.booking_title') }}</span>
    </div>
    <h1>{{ __('site.booking_title') }}</h1>
    <p>{{ __('site.booking_subtitle') }}</p>
  </div>
</div>

<section>
  <div class="container">

    @if (session('success'))
      <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-error" style="margin-bottom:24px;">
        <ul style="margin:0; padding-left:18px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="car-modal-grid" style="margin-bottom:40px; align-items:center;">
      @if ($car->image)
        <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="car-modal-img" style="height:280px;">
      @else
        <div class="car-modal-img" style="height:280px;"><i class="ti ti-car"></i></div>
      @endif
      <div>
        <p class="eyebrow">{{ __('site.booking_selected_vehicle') }}</p>
        <h2 style="margin:6px 0 14px;">{{ $car->name }}</h2>
        <p class="lead" style="max-width:none;">
          {{ number_format($car->price_per_day, 0) }} {{ $car->currency === 'AMD' ? '֏' : $car->currency }} {{ __('site.per_day') }}
        </p>
        <a href="{{ route('fleet', ['locale' => $locale]) }}" class="btn btn-outline" style="margin-top:14px;">{{ __('site.booking_change_car') }}</a>
      </div>
    </div>

    <div class="contact-grid">
      <div>
        <h3 style="margin-bottom:18px;">{{ __('site.booking_contact_info') }}</h3>

        <form method="POST" action="{{ route('booking.store', ['locale' => $locale]) }}" id="bookingForm">
          @csrf
          <input type="hidden" name="car_id" value="{{ $car->id }}">

          <div class="form-row">
            <div class="form-group">
              <label for="customer_name">{{ __('site.form_name') }}</label>
              <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
            </div>
            <div class="form-group">
              <label for="customer_phone">{{ __('site.form_phone') }}</label>
              <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="+374 __ ___ ___" required>
            </div>
          </div>
          <div class="form-group">
            <label for="customer_email">{{ __('site.form_email') }}</label>
            <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" placeholder="email@example.com">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="location_id">{{ __('site.form_location') }}</label>
              <select id="location_id" name="location_id">
                @foreach ($locations as $loc)
                  <option value="{{ $loc->id }}" {{ ($selectedLocation && $selectedLocation->id === $loc->id) ? 'selected' : '' }}>{{ $loc->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="pickup_date">{{ __('site.form_pickup_date') }}</label>
              <input type="date" id="pickup_date" name="pickup_date" value="{{ old('pickup_date') }}" required>
            </div>
            <div class="form-group">
              <label for="return_date">{{ __('site.form_return_date') }}</label>
              <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}" required>
            </div>
          </div>

          <div class="form-group">
            <label>{{ __('site.extras_title') }}</label>
            <div class="extras-row" id="extrasList">
              @foreach ($extras as $extra)
                <label class="checkbox-row">
                  <input
                    type="checkbox"
                    name="extra_ids[]"
                    value="{{ $extra->id }}"
                    class="extra-checkbox"
                    data-price="{{ $extra->price }}"
                    data-pricing-type="{{ $extra->pricing_type }}"
                  >
                  <i class="{{ $extra->icon }}"></i> {{ $extra->name }}
                  <span style="opacity:0.6; font-size:0.85rem;">
                    ({{ number_format($extra->price, 0) }} {{ $extra->currency === 'AMD' ? '֏' : $extra->currency }}{{ $extra->pricing_type === 'per_day' ? ' / ' . __('site.per_day') : '' }})
                  </span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="form-group">
            <label for="notes">{{ __('site.form_message') }}</label>
            <textarea id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
          </div>

          {{-- Price summary --}}
          <div class="admin-alert admin-alert-success" id="priceSummary" style="display:flex; justify-content:space-between; align-items:center; font-size:1.1rem; margin-top:8px;">
            <span>{{ __('site.total_to_pay') }}:</span>
            <strong id="priceTotal">{{ number_format($car->price_per_day, 0) }} {{ $car->currency === 'AMD' ? '֏' : $car->currency }}</strong>
          </div>

          {{-- Payment method selection --}}
          @php
            $cryptoEnabled = \App\Models\Setting::get('crypto_enabled', '0') === '1';
            $cryptoAddress = \App\Models\Setting::get('crypto_wallet_address', '');
            $cryptoNetwork = \App\Models\Setting::get('crypto_network', '');
            $cryptoCurrency = \App\Models\Setting::get('crypto_currency', 'USDT');
          @endphp
          <div class="form-group" style="margin-top:20px;">
            <label>{{ __('site.payment_method') }}</label>
            <div class="payment-methods">

              {{-- Pay on arrival --}}
              <label class="payment-option">
                <input type="radio" name="payment_method" value="pay_on_arrival" checked id="pm_arrival">
                <div class="payment-option-inner">
                  <i class="ti ti-clock" style="color:var(--pine);"></i>
                  <div>
                    <strong>{{ __('site.pay_on_arrival') }}</strong>
                    <p>{{ __('site.pay_on_arrival_hint') }}</p>
                  </div>
                </div>
              </label>

              {{-- Crypto --}}
              @if ($cryptoEnabled && $cryptoAddress)
              <label class="payment-option">
                <input type="radio" name="payment_method" value="crypto" id="pm_crypto">
                <div class="payment-option-inner">
                  <i class="ti ti-currency-bitcoin" style="color:#F7931A;"></i>
                  <div>
                    <strong>{{ __('site.pay_crypto') }}</strong>
                    <p>{{ $cryptoCurrency }} · {{ $cryptoNetwork }}</p>
                  </div>
                </div>
              </label>
              @endif

              {{-- Ameria Bank (disabled/coming soon) --}}
              <label class="payment-option payment-option--disabled">
                <input type="radio" name="payment_method" value="ameria_bank" disabled>
                <div class="payment-option-inner">
                  <i class="ti ti-building-bank" style="color:#999;"></i>
                  <div>
                    <strong>{{ __('site.pay_ameria') }}</strong>
                    <p>{{ __('site.pay_ameria_hint') }}</p>
                  </div>
                  <span class="tag" style="margin-left:auto; background:#E5E3DC; color:#888; font-size:0.7rem;">{{ __('admin.coming_soon') }}</span>
                </div>
              </label>

            </div>
          </div>

          {{-- Crypto payment instructions (shown when crypto selected) --}}
          @if ($cryptoEnabled && $cryptoAddress)
          <div id="cryptoInstructions" style="display:none; margin-top:16px;">
            <div class="admin-alert admin-alert-success" style="display:block;">
              <strong><i class="ti ti-info-circle"></i> {{ __('site.crypto_instructions_title') }}</strong>
              <ol style="margin:10px 0 0 18px; line-height:1.8;">
                <li>{!! __('site.crypto_step1', ['amount' => '<span id="cryptoAmount">…</span>', 'currency' => $cryptoCurrency]) !!}</li>
                <li>{{ __('site.crypto_step2', ['network' => $cryptoNetwork]) }}</li>
                <li>{{ __('site.crypto_step3') }}</li>
              </ol>
              <div style="display:flex; gap:20px; margin-top:16px; align-items:flex-start; flex-wrap:wrap;">
                <img
                  src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data={{ urlencode($cryptoAddress) }}"
                  alt="Wallet QR"
                  width="140" height="140"
                  style="border-radius:8px; border:1px solid var(--line);">
                <div>
                  <p style="font-size:0.78rem; opacity:0.6; margin-bottom:4px;">{{ $cryptoCurrency }} · {{ $cryptoNetwork }}</p>
                  <code style="font-size:0.82rem; word-break:break-all; color:var(--pine-2);">{{ $cryptoAddress }}</code>
                  <button type="button" id="copyWalletBtn" class="btn btn-outline btn-sm" style="margin-top:10px;" onclick="navigator.clipboard.writeText('{{ $cryptoAddress }}').then(()=>{ this.textContent='{{ __('site.copied') }}'; setTimeout(()=>this.textContent='{{ __('site.copy_address') }}',1500); })">
                    <i class="ti ti-copy"></i> {{ __('site.copy_address') }}
                  </button>
                </div>
              </div>
            </div>
            <div class="form-group" style="margin-top:12px;">
              <label for="crypto_txid">{{ __('site.crypto_txid_label') }}</label>
              <input type="text" id="crypto_txid" name="crypto_txid" value="{{ old('crypto_txid') }}" placeholder="{{ __('site.crypto_txid_placeholder') }}" style="font-family:monospace; font-size:0.85rem;">
              <p class="form-hint">{{ __('site.crypto_txid_hint') }}</p>
            </div>
          </div>
          @endif

          <button type="submit" class="btn btn-primary mt-lg" style="width:100%; justify-content:center;"><i class="ti ti-check"></i> {{ __('site.booking_submit') }}</button>
        </form>
      </div>

      <div>
        <div class="feature-card">
          <h3>{{ __('site.booking_highlights') }}</h3>
          <ul class="loc-info-list" style="margin-top:16px; list-style:none; display:flex; flex-direction:column; gap:14px;">
            <li><i class="ti ti-shield-check" style="color:#2C9C68;"></i> {{ __('site.adv_insurance_title') }}</li>
            <li><i class="ti ti-receipt-2" style="color:#2C9C68;"></i> {{ __('site.adv_fees_title') }}</li>
            <li><i class="ti ti-calendar-x" style="color:#2C9C68;"></i> {{ __('site.adv_cancel_title') }}</li>
            <li><i class="ti ti-headset" style="color:#2C9C68;"></i> {{ __('site.adv_support_title') }}</li>
          </ul>
        </div>

        <div class="feature-card mt-lg">
          <h3>{{ __('site.car_deposit_label') }}</h3>
          <p style="margin-top:10px;">
            {{ number_format($car->deposit_amount, 0) }} {{ $car->currency === 'AMD' ? '֏' : $car->currency }}
            <span style="color:#2C9C68; font-weight:600;">({{ __('site.refundable') }})</span>
          </p>
          <p class="form-hint" style="margin-top:8px;">{{ __('site.car_deposit_hint') }}</p>
        </div>

        <div class="feature-card mt-lg">
          <p style="font-size:0.88rem; opacity:0.7;"><i class="ti ti-lock"></i> {{ __('site.booking_secure_note') }}</p>
        </div>
      </div>
    </div>

  </div>
</section>

@push('scripts')
<script>
  (function() {
    const basePrice = {{ (float) $car->price_per_day }};
    const pickupInput = document.getElementById('pickup_date');
    const returnInput = document.getElementById('return_date');
    const totalEl = document.getElementById('priceTotal');
    const currency = '{{ $car->currency === "AMD" ? "֏" : $car->currency }}';

    function getDays() {
      if (!pickupInput.value || !returnInput.value) return 1;
      const days = Math.round((new Date(returnInput.value) - new Date(pickupInput.value)) / 86400000);
      return days > 0 ? days : 1;
    }

    function recalculate() {
      const days = getDays();
      let total = basePrice * days;

      document.querySelectorAll('.extra-checkbox:checked').forEach(cb => {
        const price = parseFloat(cb.dataset.price);
        total += cb.dataset.pricingType === 'per_day' ? price * days : price;
      });

      const formatted = Math.round(total).toLocaleString() + ' ' + currency;
      totalEl.textContent = formatted;

      // Update crypto amount display if visible
      const cryptoAmountEl = document.getElementById('cryptoAmount');
      if (cryptoAmountEl) cryptoAmountEl.textContent = formatted;
    }

    pickupInput.addEventListener('change', recalculate);
    returnInput.addEventListener('change', recalculate);
    document.querySelectorAll('.extra-checkbox').forEach(cb => cb.addEventListener('change', recalculate));
    recalculate();
  })();

  // Show/hide crypto instructions based on selected payment method
  (function() {
    const instructions = document.getElementById('cryptoInstructions');
    if (!instructions) return;

    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
      radio.addEventListener('change', function() {
        instructions.style.display = this.value === 'crypto' ? 'block' : 'none';
      });
    });
  })();

  document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const pm = document.querySelector('input[name="payment_method"]:checked')?.value;
    if (pm === 'crypto') {
      const txid = document.getElementById('crypto_txid')?.value?.trim();
      if (!txid) {
        e.preventDefault();
        document.getElementById('crypto_txid')?.focus();
        alert('{{ __("site.crypto_txid_required") }}');
        return;
      }
    }
    // No preventDefault here — let the form actually submit to booking.store
  });
</script>
@endpush

</x-layout>
