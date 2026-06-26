@php
  $locale = app()->getLocale();
@endphp
<x-layout
  :meta-title="__('site.fleet_title') . ' | Amar Rent Car Armenia'"
  :meta-description="__('site.fleet_subtitle')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ __('site.nav_fleet') }}</span></div>
    <h1>{{ __('site.fleet_title') }}</h1>
    <p>{{ __('site.fleet_subtitle') }}</p>
    @if ($selectedLocation)
      <p style="margin-top:10px; color:var(--sand); font-weight:600;"><i class="ti ti-map-pin"></i> {{ __('site.fleet_showing_for') }} {{ $selectedLocation->name }} — <a href="{{ route('fleet', ['locale' => $locale]) }}" style="text-decoration:underline; color:var(--cream);">{{ __('site.fleet_clear_location') }}</a></p>
    @endif
  </div>
</div>

<section>
  <div class="container">
    <div class="fleet-layout">

      <aside class="fleet-sidebar">
        <h4>{{ __('site.booking_class') }}</h4>
        @php($locParam = $selectedLocation ? ['location' => $selectedLocation->slug] : [])
        <a href="{{ route('fleet', array_merge(['locale' => $locale], $locParam)) }}" class="fleet-checkbox" style="text-decoration:none;">
          <input type="checkbox" {{ $category === 'all' ? 'checked' : '' }} onclick="return false;">
          {{ __('site.filter_all') }}
        </a>
        <a href="{{ route('fleet', array_merge(['locale' => $locale, 'category' => 'compact'], $locParam)) }}" class="fleet-checkbox" style="text-decoration:none;">
          <input type="checkbox" {{ $category === 'compact' ? 'checked' : '' }} onclick="return false;">
          {{ __('site.category_compact') }}
        </a>
        <a href="{{ route('fleet', array_merge(['locale' => $locale, 'category' => 'sedan'], $locParam)) }}" class="fleet-checkbox" style="text-decoration:none;">
          <input type="checkbox" {{ $category === 'sedan' ? 'checked' : '' }} onclick="return false;">
          {{ __('site.category_sedan') }}
        </a>
        <a href="{{ route('fleet', array_merge(['locale' => $locale, 'category' => 'suv'], $locParam)) }}" class="fleet-checkbox" style="text-decoration:none;">
          <input type="checkbox" {{ $category === 'suv' ? 'checked' : '' }} onclick="return false;">
          {{ __('site.category_suv') }}
        </a>
        <a href="{{ route('fleet', array_merge(['locale' => $locale, 'category' => 'premium'], $locParam)) }}" class="fleet-checkbox" style="text-decoration:none;">
          <input type="checkbox" {{ $category === 'premium' ? 'checked' : '' }} onclick="return false;">
          {{ __('site.category_premium') }}
        </a>
      </aside>

      <div>
        <p class="fleet-results-count"><strong>{{ $cars->count() }}</strong> {{ __('site.cars_found') }}</p>

        <div class="fleet-grid">
          @forelse ($cars as $car)
            @include('partials.car-card', ['car' => $car])
          @empty
            <p>{{ __('site.no_cars_found') }}</p>
          @endforelse
        </div>
      </div>

    </div>
  </div>
</section>

<section style="background:#fff">
  <div class="container">
    <div class="cta-band">
      <h2>{{ __('site.faq_not_found_title') }}</h2>
      <p>{{ __('site.faq_not_found_text') }}</p>
      <div class="hero-cta">
        <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn btn-primary">{{ __('site.contact_us') }}</a>
        @php($whatsapp = \App\Models\Setting::get('site_whatsapp', '37433123456'))
        <a href="https://wa.me/{{ $whatsapp }}" class="btn btn-outline-light"><i class="ti ti-brand-whatsapp"></i> WhatsApp</a>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  // No inline modal JS needed here – handled by partials/car-modal.blade.php
  // which is included in the global layout and uses event delegation.
</script>
@endpush

</x-layout>
