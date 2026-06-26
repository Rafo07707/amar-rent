@php
  $locale = app()->getLocale();
  $phone = \App\Models\Setting::get('site_phone', '+374 33 123 456');
  $whatsapp = \App\Models\Setting::get('site_whatsapp', '37433123456');
  $email = \App\Models\Setting::get('site_email', 'info@amarentcar.am');
  $vat = \App\Models\Setting::get('company_vat', '');
  $companyName = \App\Models\Setting::get('company_name', 'AMAR RENT CAR ARMENIA LLC');
  $footerLocations = \App\Models\Location::active()->orderBy('sort_order')->get();
@endphp
<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-logo">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:inline-block;vertical-align:middle;margin-right:6px;" aria-hidden="true">
            <circle cx="12" cy="12" r="4.5" fill="currentColor"/>
            <line x1="12" y1="2" x2="12" y2="4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="12" y1="19.5" x2="12" y2="22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="2" y1="12" x2="4.5" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="19.5" y1="12" x2="22" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="4.93" y1="4.93" x2="6.64" y2="6.64" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="17.36" y1="17.36" x2="19.07" y2="19.07" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="19.07" y1="4.93" x2="17.36" y2="6.64" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="6.64" y1="17.36" x2="4.93" y2="19.07" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          Amar Rent Car
        </div>
        <p class="footer-tagline">{{ __('site.tagline') }}</p>
        <a href="https://wa.me/{{ $whatsapp }}" class="btn btn-outline-light" style="font-size:0.85rem; padding:10px 20px;"><i class="ti ti-brand-whatsapp"></i> WhatsApp</a>
      </div>
      <div>
        <h4>{{ __('site.footer_links') }}</h4>
        <ul>
          <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a></li>
          <li><a href="{{ route('fleet', ['locale' => $locale]) }}">{{ __('site.nav_fleet') }}</a></li>
          <li><a href="{{ route('services', ['locale' => $locale]) }}">{{ __('site.nav_services') }}</a></li>
          <li><a href="{{ route('about', ['locale' => $locale]) }}">{{ __('site.nav_about') }}</a></li>
          <li><a href="{{ route('contact', ['locale' => $locale]) }}">{{ __('site.nav_contact') }}</a></li>
        </ul>
      </div>
      <div>
        <h4>{{ __('site.footer_locations') }}</h4>
        <ul>
          @foreach ($footerLocations as $loc)
            <li><a href="{{ route('location.show', ['locale' => $locale, 'location' => $loc->slug]) }}">{{ $loc->name }}</a></li>
          @endforeach
          <li><a href="{{ route('locations', ['locale' => $locale]) }}">{{ __('site.nav_locations') }}</a></li>
        </ul>
      </div>
      <div>
        <h4>{{ __('site.footer_legal') }}</h4>
        <ul>
          <li><a href="{{ route('privacy', ['locale' => $locale]) }}">{{ __('site.footer_privacy') }}</a></li>
          <li><a href="{{ route('terms', ['locale' => $locale]) }}">{{ __('site.footer_terms') }}</a></li>
          <li><a href="{{ route('faq', ['locale' => $locale]) }}">{{ __('site.nav_faq') }}</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; {{ date('Y') }} {{ strtoupper($companyName) }}. {{ __('site.footer_rights') }}</span>
      @if ($vat)
        <span>{{ __('site.footer_vat') }}: {{ $vat }}</span>
      @endif
    </div>
  </div>
</footer>
