@php
  $locale = app()->getLocale();
@endphp
<x-layout
  :meta-title="$location->name . ' | Amar Rent Car Armenia'"
  :meta-description="$location->description"
>

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Amar Rent Car Armenia — {{ $location->name }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $location->address }}",
    "addressCountry": "AM"
  },
  @if ($location->latitude && $location->longitude)
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "{{ $location->latitude }}",
    "longitude": "{{ $location->longitude }}"
  },
  @endif
  "openingHoursSpecification": "{{ $location->working_hours }}",
  "url": "{{ url()->current() }}"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "{{ __('site.nav_home') }}", "item": "{{ route('home', ['locale' => $locale]) }}" },
    { "@type": "ListItem", "position": 2, "name": "{{ __('site.nav_locations') }}", "item": "{{ route('locations', ['locale' => $locale]) }}" },
    { "@type": "ListItem", "position": 3, "name": "{{ $location->name }}", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endpush

<div class="page-header">
  <div class="container">
    <div class="breadcrumb">
      <a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> /
      <a href="{{ route('locations', ['locale' => $locale]) }}">{{ __('site.nav_locations') }}</a> /
      <span>{{ $location->name }}</span>
    </div>
    <h1>{{ $location->name }}</h1>
    <p>{{ $location->description }}</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="loc-section">
      <div class="loc-img"><i class="{{ $location->icon }}"></i></div>
      <div class="loc-text">
        <p class="eyebrow">{{ __('site.nav_locations') }}</p>
        <h2>{{ $location->name }}</h2>
        <p class="lead" style="max-width:none;">{{ $location->description }}</p>
        <ul class="loc-info-list">
          <li><i class="ti ti-map-pin"></i> {{ $location->address }}</li>
          <li><i class="ti ti-clock"></i> {{ $location->working_hours }}</li>
        </ul>
        <a href="{{ route('fleet', ['locale' => $locale, 'location' => $location->slug]) }}" class="btn btn-primary mt-lg">{{ __('site.book_in') }} {{ $location->name }}</a>
      </div>
    </div>
  </div>
</section>

<section style="background:#fff">
  <div class="container">
    <div class="cta-band">
      <h2>{{ __('site.fleet_title') }}</h2>
      <p>{{ __('site.fleet_subtitle') }}</p>
      <div class="hero-cta">
        <a href="{{ route('fleet', ['locale' => $locale]) }}" class="btn btn-primary">{{ __('site.view_fleet') }}</a>
        <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn btn-outline-light">{{ __('site.contact_us') }}</a>
      </div>
    </div>
  </div>
</section>

</x-layout>
