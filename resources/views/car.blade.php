@php
  $locale = app()->getLocale();
@endphp
<x-layout
  :meta-title="$car->name . ' | Amar Rent Car Armenia'"
  :meta-description="$car->description"
>

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{ $car->name }}",
  "description": "{{ str_replace(["\n", '"'], ['', "'"], $car->description) }}",
  "category": "{{ __('site.category_' . $car->category) }}",
  "image": "{{ $car->image ? $car->image_url : asset('assets/images/car-placeholder.svg') }}",
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "{{ $car->currency }}",
    "price": "{{ $car->price_per_day }}",
    "availability": "{{ $car->is_active ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "{{ __('site.nav_home') }}", "item": "{{ route('home', ['locale' => $locale]) }}" },
    { "@type": "ListItem", "position": 2, "name": "{{ __('site.nav_fleet') }}", "item": "{{ route('fleet', ['locale' => $locale]) }}" },
    { "@type": "ListItem", "position": 3, "name": "{{ $car->name }}", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endpush

<div class="page-header">
  <div class="container">
    <div class="breadcrumb">
      <a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> /
      <a href="{{ route('fleet', ['locale' => $locale]) }}">{{ __('site.nav_fleet') }}</a> /
      <span>{{ $car->name }}</span>
    </div>
    <h1>{{ $car->name }}</h1>
    <p>{{ __('site.category_' . $car->category) }}</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="car-detail-grid">
      <div class="car-detail-img">
        @if ($car->image)
          <img src="{{ $car->image_url }}" alt="{{ $car->name }}">
        @else
          <i class="ti ti-car"></i>
        @endif
      </div>
      <div>
        <p class="lead" style="max-width:none;">{{ $car->description }}</p>

        <ul class="spec-list">
          <li><i class="ti ti-users"></i> {{ $car->seats }} {{ __('site.seats') }}</li>
          <li><i class="ti ti-briefcase"></i> {{ $car->bags }} {{ __('admin.car_bags') }}</li>
          <li><i class="ti ti-manual-gearbox"></i> {{ __('site.transmission_' . $car->transmission) }}</li>
          <li><i class="ti ti-gas-station"></i> {{ __('site.fuel_' . $car->fuel_type) }}</li>
          <li><i class="ti ti-shield-check"></i> {{ __('site.adv_insurance_title') }}</li>
          <li><i class="ti ti-road"></i> {{ $car->included_km_per_day > 0 ? $car->included_km_per_day . ' km/' . __('site.per_day') : __('site.unlimited_mileage') }}</li>
        </ul>

        <div class="car-modal-info-box" style="margin-top:16px;">
          <strong>{{ __('site.car_deposit_label') }}:</strong> {{ number_format($car->deposit_amount, 0) }} {{ $car->currency === 'AMD' ? '֏' : $car->currency }}
          <span style="color:#2C9C68;">({{ __('site.refundable') }})</span>
        </div>

        <div class="car-price" style="font-size:2rem; margin: 20px 0;">
          {{ number_format($car->price_per_day, 0) }} {{ $car->currency === 'AMD' ? '֏' : $car->currency }}
          <span style="font-size:1rem;">{{ __('site.per_day') }}</span>
        </div>

        <a href="{{ route('booking.show', ['locale' => $locale, 'car' => $car->slug]) }}" class="btn btn-primary">{{ __('site.book') }} <i class="ti ti-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

@if ($related->isNotEmpty())
<section style="background:#fff">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">{{ __('site.category_' . $car->category) }}</p>
      <h2>{{ __('site.fleet_title') }}</h2>
    </div>
    <div class="grid-3">
      @foreach ($related as $relatedCar)
        @include('partials.car-card', ['car' => $relatedCar])
      @endforeach
    </div>
  </div>
</section>
@endif

</x-layout>
