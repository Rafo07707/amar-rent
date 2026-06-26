<header class="site-header">
  <div class="nav-wrap">
    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo">
      <img src="{{ asset('logo.png') }}" alt="Amar Rent Car" class="logo-img" width="auto" height="50" style="object-fit: contain">
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
