@props(['metaTitle' => null, 'metaDescription' => null])
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#1F4D3D">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="mobile-web-app-capable" content="yes">

<title>{{ $metaTitle ?? config('app.name') }}</title>
<meta name="robots" content="index, follow">
<meta name="description" content="{{ $metaDescription ?? '' }}">

{{-- hreflang alternate links for SEO --}}
@foreach (\App\Http\Middleware\SetLocale::SUPPORTED as $altLocale)
    <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url()->current() !== url('/') ? str_replace('/'.app()->getLocale().'/', '/'.$altLocale.'/', request()->fullUrlWithQuery([])) : url('/'.$altLocale) }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ url('/'.config('app.locale')) }}">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ __('site.site_name') }}">
<meta property="og:title" content="{{ $metaTitle ?? config('app.name') }}">
<meta property="og:description" content="{{ $metaDescription ?? '' }}">
<meta property="og:locale" content="{{ app()->getLocale() }}">
<meta property="og:url" content="{{ url()->current() }}">

<link rel="canonical" href="{{ url()->current() }}">

{{-- Structured data: LocalBusiness / AutoRental, helps Google Knowledge Panel + local search --}}
@php
  $structuredDataPhone = \App\Models\Setting::get('site_phone', '+374 33 123 456');
  $structuredDataEmail = \App\Models\Setting::get('site_email', 'info@amarentcar.am');
  $structuredDataAddress = \App\Models\Setting::get('address', 'Komitas Ave. 38, Yerevan, Armenia');
@endphp
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AutoRental",
  "name": "Amar Rent Car Armenia",
  "image": "{{ asset('assets/images/car-placeholder.svg') }}",
  "url": "{{ url('/' . app()->getLocale()) }}",
  "telephone": "{{ $structuredDataPhone }}",
  "email": "{{ $structuredDataEmail }}",
  "priceRange": "$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $structuredDataAddress }}",
    "addressCountry": "AM"
  },
  "areaServed": "Armenia"
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&family=Noto+Sans+Armenian:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
  body, h1, h2, h3, h4, .logo, .footer-logo, .step-num, .stat-num, .car-price { font-family: 'Noto Sans Armenian', var(--font-body); }
  h1, h2, h3, h4, .footer-logo, .step-num, .stat-num, .car-price { font-family: 'Noto Sans Armenian', var(--font-display); }
</style>
@stack('styles')
</head>
<body>

@include('partials.header')

@if (session('success'))
  <div class="container" style="padding-top:24px;">
    <div class="alert alert-success">{{ session('success') }}</div>
  </div>
@endif

<div class="page-transition">
  {{ $slot }}
</div>

@include('partials.footer')
@include('partials.bottom-nav')
@include('partials.car-modal')

<script>
  document.getElementById('navToggle')?.addEventListener('click', function() {
    document.getElementById('mainNav').classList.toggle('open');
  });

  // App-like page entrance transition
  requestAnimationFrame(() => {
    document.querySelector('.page-transition')?.classList.add('is-visible');
  });

  // Touch ripple feedback on buttons/cards/nav for an app-like tactile feel
  (function() {
    const tappable = 'a.btn, button.btn, .car-card-actions .btn, .bottom-nav a, .filter-chip, .filter-pill, .fleet-checkbox, .faq-question, .car-card';
    document.addEventListener('touchstart', function(e) {
      const el = e.target.closest(tappable);
      if (el) el.classList.add('is-pressed');
    }, { passive: true });
    document.addEventListener('touchend', function(e) {
      const el = e.target.closest(tappable);
      if (el) setTimeout(() => el.classList.remove('is-pressed'), 120);
    }, { passive: true });
  })();
</script>
@stack('scripts')
</body>
</html>
