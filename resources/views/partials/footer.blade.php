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
          <img src="{{ asset('logo.png') }}" alt="Amar Rent Car" width="auto" height="50" style="object-fit: contain">
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
