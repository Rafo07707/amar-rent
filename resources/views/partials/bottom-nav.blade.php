@php
  $locale = app()->getLocale();
@endphp
<nav class="bottom-nav">
  <a href="{{ route('home', ['locale' => $locale]) }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
    <i class="ti ti-home"></i>
    <span>{{ __('site.nav_home') }}</span>
  </a>
  <a href="{{ route('fleet', ['locale' => $locale]) }}" class="{{ request()->routeIs('fleet') || request()->routeIs('car.show') ? 'active' : '' }}">
    <i class="ti ti-car"></i>
    <span>{{ __('site.nav_fleet') }}</span>
  </a>
  <a href="{{ route('fleet', ['locale' => $locale]) }}" class="bottom-nav-cta">
    <i class="ti ti-calendar-plus"></i>
  </a>
  <a href="{{ route('locations', ['locale' => $locale]) }}" class="{{ request()->routeIs('locations') || request()->routeIs('location.show') ? 'active' : '' }}">
    <i class="ti ti-map-pin"></i>
    <span>{{ __('site.nav_locations') }}</span>
  </a>
  <a href="{{ route('contact', ['locale' => $locale]) }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
    <i class="ti ti-message-circle"></i>
    <span>{{ __('site.nav_contact') }}</span>
  </a>
</nav>
