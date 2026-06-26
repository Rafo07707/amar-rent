<x-admin-layout :title="__('admin.settings')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.settings') }}</h1>
  </div>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf
  @method('PUT')

  <div class="admin-card">
    <div class="form-grid">
      <div class="form-group">
        <label>{{ __('admin.site_phone') }}</label>
        <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.site_whatsapp') }}</label>
        <input type="text" name="site_whatsapp" value="{{ old('site_whatsapp', $settings['site_whatsapp']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.site_email') }}</label>
        <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.company_name') }}</label>
        <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.company_vat') }}</label>
        <input type="text" name="company_vat" value="{{ old('company_vat', $settings['company_vat']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.working_hours') }}</label>
        <input type="text" name="working_hours" value="{{ old('working_hours', $settings['working_hours']) }}">
      </div>
      <div class="form-group" style="grid-column: span 2;">
        <label>{{ __('admin.address') }}</label>
        <input type="text" name="address" value="{{ old('address', $settings['address']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.facebook_url') }}</label>
        <input type="text" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.instagram_url') }}</label>
        <input type="text" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}">
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> {{ __('admin.save') }}</button>

  {{-- ===== Crypto Payment ===== --}}
  <div class="admin-card" style="margin-top:32px;">
    <h3 style="margin-bottom:20px; font-size:1rem;">
      <i class="ti ti-currency-bitcoin" style="color:var(--rust);"></i>
      {{ __('admin.crypto_payment') }}
    </h3>
    <div class="form-grid">
      <div class="form-group" style="grid-column:span 2;">
        <label class="checkbox-inline">
          <input type="checkbox" name="crypto_enabled" value="1" {{ ($settings['crypto_enabled'] ?? '0') === '1' ? 'checked' : '' }}>
          {{ __('admin.crypto_enabled') }}
        </label>
        <p class="form-hint">{{ __('admin.crypto_enabled_hint') }}</p>
      </div>
      <div class="form-group">
        <label>{{ __('admin.crypto_currency') }}</label>
        <input type="text" name="crypto_currency" value="{{ old('crypto_currency', $settings['crypto_currency'] ?? '') }}" placeholder="USDT">
        <p class="form-hint">{{ __('admin.crypto_currency_hint') }}</p>
      </div>
      <div class="form-group">
        <label>{{ __('admin.crypto_network') }}</label>
        <input type="text" name="crypto_network" value="{{ old('crypto_network', $settings['crypto_network'] ?? '') }}" placeholder="TRC-20">
        <p class="form-hint">{{ __('admin.crypto_network_hint') }}</p>
      </div>
      <div class="form-group" style="grid-column:span 2;">
        <label>{{ __('admin.crypto_wallet_address') }}</label>
        <input type="text" name="crypto_wallet_address"
               value="{{ old('crypto_wallet_address', $settings['crypto_wallet_address'] ?? '') }}"
               placeholder="T9yD14Nj9j7xAB4dbGeiX9h8upfCg9PLS"
               style="font-family:monospace; font-size:0.88rem;">
        <p class="form-hint">{{ __('admin.crypto_wallet_hint') }}</p>
      </div>
    </div>

    @if (!empty($settings['crypto_wallet_address']))
      <div style="margin-top:16px; display:inline-block; padding:12px; background:#fff; border:1px solid var(--line); border-radius:var(--radius);">
        <p class="form-hint" style="margin-bottom:8px;">{{ __('admin.crypto_qr_preview') }}:</p>
        <img
          src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode($settings['crypto_wallet_address']) }}"
          alt="Wallet QR"
          width="160" height="160"
          style="display:block;">
        <p style="font-size:0.74rem; margin-top:8px; opacity:0.6; max-width:160px; word-break:break-all; font-family:monospace;">{{ $settings['crypto_wallet_address'] }}</p>
      </div>
    @endif
  </div>

  {{-- ===== Ameria Bank (Disabled) ===== --}}
  <div class="admin-card" style="margin-top:24px; opacity:0.7;">
    <h3 style="margin-bottom:16px; font-size:1rem;">
      <i class="ti ti-building-bank" style="color:#888;"></i>
      {{ __('admin.ameria_bank') }}
      <span class="tag" style="margin-left:8px; background:#E5E3DC; color:#666;">{{ __('admin.coming_soon') }}</span>
    </h3>
    <div class="form-grid">
      <div class="form-group">
        <label class="checkbox-inline" style="opacity:0.5; cursor:not-allowed;">
          <input type="checkbox" name="ameria_bank_enabled" value="1" disabled>
          {{ __('admin.ameria_bank_enabled') }}
        </label>
        <p class="form-hint">{{ __('admin.ameria_bank_hint') }}</p>
      </div>
      <div class="form-group">
        <label>{{ __('admin.ameria_bank_merchant') }}</label>
        <input type="text" name="ameria_bank_merchant"
               value="{{ old('ameria_bank_merchant', $settings['ameria_bank_merchant'] ?? '') }}"
               placeholder="Merchant ID"
               disabled>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" style="margin-top:24px;"><i class="ti ti-check"></i> {{ __('admin.save') }}</button>
</form>

</x-admin-layout>
