@props(['metaTitle' => null, 'metaDescription' => null])
@php
  $locale = app()->getLocale();
  $ogImage = asset('og_image.png');
  $logoUrl = asset('logo.png');
  $faviconUrl = asset('favicon.ico');
  $seoKeywords = [
    'hy' => 'Ավտո վարձույթ Հայաստան, Ավտո վարձ Երևան, Rent Car Armenia, Ավտո վարձ Գյումրի, Ավտո վարձ Դիլիջան, Amar Rent Car, Ավտոմեքենա վարձ Հայաստան',
    'ru' => 'Аренда авто Армения, Аренда машины Ереван, Rent Car Armenia, Прокат авто Армения, Аренда авто Гюмри, Amar Rent Car, Аренда машины Армения',
    'en' => 'Rent Car Armenia, Car Rental Yerevan, Armenia Car Rental, Rent a Car Armenia, Car Hire Armenia, Amar Rent Car, Car Rental Gyumri Dilijan',
  ];
  $canonicalUrl = url()->current();
  $siteName = 'Amar Rent Car Armenia';
  $title = $metaTitle ?? $siteName;
  $description = $metaDescription ?? __('site.tagline');
  $structuredDataPhone = \App\Models\Setting::get('site_phone', '+374 33 123 456');
  $structuredDataEmail = \App\Models\Setting::get('site_email', 'info@amar-rent.am');
  $structuredDataAddress = \App\Models\Setting::get('address', 'Komitas Ave. 38, Yerevan, Armenia');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" prefix="og: https://ogp.me/ns#">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

{{-- Primary SEO --}}
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $seoKeywords[$locale] ?? $seoKeywords['en'] }}">
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Mobile / PWA --}}
<meta name="theme-color" content="#1F4D3D">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="Amar Rent Car">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="Amar Rent Car">

{{-- Favicon --}}
<link rel="icon" type="image/png" href="{{ $faviconUrl }}">
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">

{{-- Hreflang for multilingual SEO --}}
@foreach (\App\Http\Middleware\SetLocale::SUPPORTED as $altLocale)
  <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ str_replace('/'.$locale.'/', '/'.$altLocale.'/', $canonicalUrl) }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ url('/'.config('app.locale')) }}">

{{-- Open Graph (Facebook, Telegram, LinkedIn, Viber) --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:locale" content="{{ $locale === 'hy' ? 'hy_AM' : ($locale === 'ru' ? 'ru_RU' : 'en_US') }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:secure_url" content="{{ $ogImage }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Amar Rent Car Armenia">

{{-- Twitter / X Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@amarentcar">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="Amar Rent Car Armenia">

{{-- JSON-LD: AutoRental / LocalBusiness --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AutoRental",
  "name": "{{ $siteName }}",
  "image": "{{ $ogImage }}",
  "logo": "{{ $logoUrl }}",
  "url": "{{ url('/' . $locale) }}",
  "telephone": "{{ $structuredDataPhone }}",
  "email": "{{ $structuredDataEmail }}",
  "description": "{{ $description }}",
  "priceRange": "$$",
  "currenciesAccepted": "AMD, USD",
  "paymentAccepted": "Cash, Cryptocurrency",
  "openingHours": "Mo-Su 08:00-22:00",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $structuredDataAddress }}",
    "addressLocality": "Yerevan",
    "addressCountry": "AM"
  },
  "areaServed": [
    { "@type": "City", "name": "Yerevan" },
    { "@type": "City", "name": "Gyumri" },
    { "@type": "City", "name": "Dilijan" },
    { "@type": "City", "name": "Tsaghkadzor" }
  ],
  "sameAs": [
    "https://facebook.com/amarentcar",
    "https://instagram.com/amarentcar"
  ]
}
</script>

{{-- Fonts --}}
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

  requestAnimationFrame(() => {
    document.querySelector('.page-transition')?.classList.add('is-visible');
  });

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
