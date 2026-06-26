@php
  $locale = app()->getLocale();
  $currency = $car->currency === 'AMD' ? '֏' : $car->currency;

  // Embed all data the modal needs directly into the button as JSON.
  // This way the modal partial works on ANY page (home, fleet, car detail) without
  // needing a separate carsData JS array that was only available on fleet.blade.php.
  $extras = \App\Models\Extra::active()->get()->map(fn($e) => [
    'name'    => $e->name,
    'price'   => number_format($e->price, 0) . ' ' . ($e->currency === 'AMD' ? '֏' : $e->currency),
    'icon'    => $e->icon,
    'per_day' => $e->pricing_type === 'per_day',
  ])->values()->toArray();

  $carData = json_encode([
    'slug'     => $car->slug,
    'name'     => $car->name,
    'category' => __('site.category_' . $car->category),
    'image'    => $car->image ? $car->image_url : null,
    'price'    => number_format($car->price_per_day, 0) . ' ' . $currency,
    'deposit'  => number_format($car->deposit_amount ?? 0, 0) . ' ' . $currency,
    'km'       => $car->included_km_per_day ?? 0,
    'seats'    => $car->seats,
    'bags'     => $car->bags ?? 2,
    'bookUrl'  => route('booking.show', ['locale' => $locale, 'car' => $car->slug]),
    'extras'   => $extras,
  ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
@endphp
<div class="car-card" data-cat="{{ $car->category }}">
  <div class="car-card-img">
    @if ($car->image)
      <img src="{{ $car->image_url }}" alt="{{ $car->name }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
    @else
      <i class="ti ti-car"></i>
    @endif
  </div>
  <div class="car-card-body">
    <span class="car-card-tag">{{ __('site.category_' . $car->category) }}</span>
    <h3>{{ $car->name }}</h3>
    <div class="car-card-specs">
      <span><i class="ti ti-users"></i> {{ $car->seats }} {{ __('site.seats') }}</span>
      <span><i class="ti ti-manual-gearbox"></i> {{ __('site.transmission_' . $car->transmission) }}</span>
      <span><i class="ti ti-gas-station"></i> {{ __('site.fuel_' . $car->fuel_type) }}</span>
    </div>
    <div class="car-card-footer">
      <div class="car-price">{{ number_format($car->price_per_day, 0) }} {{ $currency }} <span>{{ __('site.per_day') }}</span></div>
    </div>
    <div class="car-card-actions">
      <a href="{{ route('booking.show', ['locale' => $locale, 'car' => $car->slug]) }}" class="btn btn-primary">{{ __('site.book') }}</a>
      <button type="button" class="btn btn-outline" data-open-car-modal="1" data-car='{!! $carData !!}'>{{ __('site.view_details') }}</button>
    </div>
  </div>
</div>
