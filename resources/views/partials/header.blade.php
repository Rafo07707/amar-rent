<header class="site-header">
  <div class="nav-wrap">
    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo">
      <span class="mark">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
      </span>
      Amar Rent Car
    </a>
    <nav class="main-nav" id="mainNav">
      <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('site.nav_home') }}</a>
      <a href="{{ route('fleet', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('fleet') || request()->routeIs('car.show') ? 'active' : '' }}">{{ __('site.nav_fleet') }}</a>
      <a href="{{ route('locations', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('locations') || request()->routeIs('location.show') ? 'active' : '' }}">{{ __('site.nav_locations') }}</a>
      <a href="{{ route('services', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __('site.nav_services') }}</a>
      <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('site.nav_about') }}</a>
      <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('site.nav_contact') }}</a>
    </nav>
    <div class="nav-actions">
      @php($phone = \App\Models\Setting::get('site_phone', '+374 33 123 456'))
      <a href="tel:{{ str_replace(' ', '', $phone) }}" class="nav-phone"><i class="ti ti-phone"></i> {{ $phone }}</a>
      <div class="lang-switch">
        @foreach (\App\Http\Middleware\SetLocale::SUPPORTED as $altLocale)
          <a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName() ?: 'home', array_merge(request()->route()->parameters(), ['locale' => $altLocale])) }}"
             class="{{ app()->getLocale() === $altLocale ? 'active' : '' }}">{{ $altLocale }}</a>
        @endforeach
      </div>
      <a href="{{ route('fleet', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">{{ __('site.nav_book_now') }}</a>
      <button class="nav-toggle" id="navToggle" aria-label="Menu"><i class="ti ti-menu-2"></i></button>
    </div>
  </div>
</header>
