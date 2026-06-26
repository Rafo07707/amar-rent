@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ? $title . ' — ' : '' }}{{ __('admin.admin_panel') }} | Amar Rent Car</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Armenian:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@stack('styles')
</head>
<body>

<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-logo">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0;" aria-hidden="true">
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
      Amar Admin
    </div>
    <nav class="admin-nav">
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="ti ti-layout-dashboard"></i> {{ __('admin.dashboard') }}</a>
      <a href="{{ route('admin.cars.index') }}" class="{{ request()->routeIs('admin.cars.*') ? 'active' : '' }}"><i class="ti ti-car"></i> {{ __('admin.cars') }}</a>
      <a href="{{ route('admin.extras.index') }}" class="{{ request()->routeIs('admin.extras.*') ? 'active' : '' }}"><i class="ti ti-plus"></i> {{ __('admin.extras') }}</a>
      <a href="{{ route('admin.locations.index') }}" class="{{ request()->routeIs('admin.locations.*') ? 'active' : '' }}"><i class="ti ti-map-pin"></i> {{ __('admin.locations') }}</a>
      <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"><i class="ti ti-clipboard-list"></i> {{ __('admin.bookings') }}
        @php($newCount = \App\Models\Booking::bookings()->where('status', 'new')->count())
        @if($newCount > 0)<span class="badge">{{ $newCount }}</span>@endif
      </a>
      <a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}"><i class="ti ti-message-circle"></i> {{ __('admin.inquiries') }}
        @php($newInquiryCount = \App\Models\Booking::inquiries()->where('status', 'new')->count())
        @if($newInquiryCount > 0)<span class="badge">{{ $newInquiryCount }}</span>@endif
      </a>
      <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}"><i class="ti ti-file-text"></i> {{ __('admin.pages') }}</a>
      <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"><i class="ti ti-help-circle"></i> {{ __('admin.faqs') }}</a>
      <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="ti ti-settings"></i> {{ __('admin.settings') }}</a>
    </nav>
    <div class="admin-sidebar-footer">
      <a href="{{ route('home', ['locale' => config('app.locale')]) }}" target="_blank"><i class="ti ti-external-link"></i> {{ __('admin.view_site') }}</a>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit"><i class="ti ti-logout"></i> {{ __('admin.logout') }}</button>
      </form>
    </div>
  </aside>

  <main class="admin-main">
    <button class="admin-mobile-toggle" id="adminNavToggle" aria-label="Menu"><i class="ti ti-menu-2"></i></button>

    @if (session('success'))
      <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="admin-alert admin-alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{ $slot }}
  </main>
</div>

<script>
  document.getElementById('adminNavToggle')?.addEventListener('click', function() {
    document.querySelector('.admin-sidebar').classList.toggle('open');
  });
</script>
@stack('scripts')
</body>
</html>
