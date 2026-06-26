@php
  $locale = app()->getLocale();
  $whatsapp = \App\Models\Setting::get('site_whatsapp', '37433123456');
  $phone = \App\Models\Setting::get('site_phone', '+374 33 123 456');
  $email = \App\Models\Setting::get('site_email', 'info@amarentcar.am');
  $hours = \App\Models\Setting::get('working_hours', 'Mon-Sun: 08:00 - 22:00');
  $address = \App\Models\Setting::get('address', 'Komitas Ave. 38, Yerevan, Armenia');
  $locations = \App\Models\Location::active()->orderBy('sort_order')->get();
@endphp
<x-layout
  :meta-title="$page?->getTranslation('meta_title') ?: __('site.nav_contact')"
  :meta-description="$page?->getTranslation('meta_description')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ __('site.nav_contact') }}</span></div>
    <h1>{{ $page?->getTranslation('title') ?: __('site.contact_title') }}</h1>
    <p>{{ $page?->getTranslation('content') ?: __('site.contact_subtitle') }}</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="contact-grid">
      <div>
        <h2>{{ __('site.contact_title') }}</h2>
        <p class="lead" style="margin:12px 0 28px;">{{ __('site.contact_subtitle') }}</p>

        @if (session('success'))
          <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
          <div class="alert alert-error">
            <ul style="margin:0; padding-left:18px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('contact.store', ['locale' => $locale]) }}">
          @csrf
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
          <div class="form-group">
            <label for="location_id">{{ __('site.form_location') }}</label>
            <select id="location_id" name="location_id">
              <option value="">{{ __('site.filter_all') }}</option>
              @foreach ($locations as $loc)
                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="notes">{{ __('site.form_message') }}</label>
            <textarea id="notes" name="notes" rows="5">{{ old('notes') }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary"><i class="ti ti-send"></i> {{ __('site.form_send') }}</button>
        </form>
      </div>

      <div>
        <div class="contact-info-card">
          <h3>{{ __('site.contact_info_title') }}</h3>
          <div class="contact-info-row">
            <i class="ti ti-phone icon"></i>
            <div>
              <strong>{{ __('site.phone_label') }}</strong><br>
              {{ $phone }}
            </div>
          </div>
          <div class="contact-info-row">
            <i class="ti ti-mail icon"></i>
            <div>
              <strong>{{ __('site.email_label') }}</strong><br>
              {{ $email }}
            </div>
          </div>
          <div class="contact-info-row">
            <i class="ti ti-clock icon"></i>
            <div>
              <strong>{{ __('site.hours_label') }}</strong><br>
              {{ $hours }}
            </div>
          </div>
          <div class="contact-info-row">
            <i class="ti ti-map-pin icon"></i>
            <div>
              <strong>{{ __('site.address_label') }}</strong><br>
              {{ $address }}
            </div>
          </div>
          <a href="https://wa.me/{{ $whatsapp }}" class="btn btn-outline-light mt-lg" style="width:100%; justify-content:center;"><i class="ti ti-brand-whatsapp"></i> {{ __('site.whatsapp') }}</a>
        </div>

        <div class="feature-card mt-lg">
          <h3>{{ __('site.footer_locations') }}</h3>
          <ul class="loc-info-list" style="margin-top:16px; list-style:none; display:flex; flex-direction:column; gap:12px;">
            @foreach ($locations as $loc)
              <li><strong>{{ $loc->name }}</strong> — {{ $loc->address }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

</x-layout>
