@php
  $locale = app()->getLocale();
@endphp
<x-layout
  :meta-title="__('site.locations_page_title') . ' | Amar Rent Car Armenia'"
  :meta-description="__('site.locations_page_subtitle')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ __('site.nav_locations') }}</span></div>
    <h1>{{ __('site.locations_page_title') }}</h1>
    <p>{{ __('site.locations_page_subtitle') }}</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="grid-3">
      @foreach ($locations as $i => $loc)
        @php
          $shades = ['#3a5a4d', '#2d4a3d', '#1f4d3d', '#16382c'];
        @endphp
        <div class="location-card" style="background-color:{{ $shades[$i % 4] }}">
          <div class="location-card-content">
            <h3>{{ $loc->name }}</h3>
            <p>{{ $loc->description }}</p>
            <a href="{{ route('location.show', ['locale' => $locale, 'location' => $loc->slug]) }}">{{ __('site.book_in') }} {{ $loc->name }} <i class="ti ti-arrow-right"></i></a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

</x-layout>
