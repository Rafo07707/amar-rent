<x-layout
  :meta-title="$page?->getTranslation('meta_title') ?: __('site.hero_title')"
  :meta-description="$page?->getTranslation('meta_description') ?: __('site.hero_lead')"
>

<section class="hero">
  <div class="hero-bg-shape"></div>
  <div class="hero-inner">
    <p class="eyebrow" style="color:var(--sand)">{{ __('site.hero_eyebrow') }}</p>
    <h1>{{ __('site.hero_title') }}</h1>
    <p class="lead">{{ __('site.hero_lead') }}</p>
    <div class="hero-cta">
      <a href="{{ route('fleet', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">{{ __('site.view_fleet') }} <i class="ti ti-arrow-right"></i></a>
      <a href="#booking" class="btn btn-outline-light">{{ __('site.get_quote') }}</a>
    </div>

    <form method="GET" action="{{ route('fleet', ['locale' => app()->getLocale()]) }}" class="booking-widget" id="booking">
      <div class="form-group">
        <label>{{ __('site.booking_location') }}</label>
        <select name="location">
          @foreach ($locations as $loc)
            <option value="{{ $loc->slug }}">{{ $loc->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>{{ __('site.booking_pickup_date') }}</label>
        <input type="date">
      </div>
      <div class="form-group">
        <label>{{ __('site.booking_return_date') }}</label>
        <input type="date">
      </div>
      <div class="form-group">
        <label>{{ __('site.booking_class') }}</label>
        <select name="category">
          <option value="all">{{ __('site.class_any') }}</option>
          <option value="compact">{{ __('site.class_compact') }}</option>
          <option value="sedan">{{ __('site.class_sedan') }}</option>
          <option value="suv">{{ __('site.class_suv') }}</option>
          <option value="premium">{{ __('site.class_premium') }}</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i> {{ __('site.search') }}</button>
    </form>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">{{ __('site.advantages_eyebrow') }}</p>
      <h2>{{ __('site.advantages_title') }}</h2>
    </div>
    <div class="grid-3">
      <div class="feature-card">
        <div class="icon"><i class="ti ti-shield-check"></i></div>
        <h3>{{ __('site.adv_insurance_title') }}</h3>
        <p>{{ __('site.adv_insurance_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-receipt-2"></i></div>
        <h3>{{ __('site.adv_fees_title') }}</h3>
        <p>{{ __('site.adv_fees_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-map-pin"></i></div>
        <h3>{{ __('site.adv_delivery_title') }}</h3>
        <p>{{ __('site.adv_delivery_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-moon-stars"></i></div>
        <h3>{{ __('site.adv_night_title') }}</h3>
        <p>{{ __('site.adv_night_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-headset"></i></div>
        <h3>{{ __('site.adv_support_title') }}</h3>
        <p>{{ __('site.adv_support_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-calendar-x"></i></div>
        <h3>{{ __('site.adv_cancel_title') }}</h3>
        <p>{{ __('site.adv_cancel_text') }}</p>
      </div>
    </div>
  </div>
</section>

<div class="stats-bar">
  <div class="container">
    <div class="stats-grid">
      <div>
        <div class="stat-num">100%</div>
        <div class="stat-label">{{ __('site.stat_insurance') }}</div>
      </div>
      <div>
        <div class="stat-num">24/7</div>
        <div class="stat-label">{{ __('site.stat_support') }}</div>
      </div>
      <div>
        <div class="stat-num">0 ֏</div>
        <div class="stat-label">{{ __('site.stat_fees') }}</div>
      </div>
      <div>
        <div class="stat-num">{{ $locations->count() }}</div>
        <div class="stat-label">{{ __('site.stat_locations') }}</div>
      </div>
    </div>
  </div>
</div>

@if ($featuredCars->isNotEmpty())
<section style="background:#fff">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">{{ __('site.fleet_title') }}</p>
      <h2>{{ __('site.fleet_subtitle') }}</h2>
    </div>
    <div class="grid-3">
      @foreach ($featuredCars as $car)
        @include('partials.car-card', ['car' => $car])
      @endforeach
    </div>
  </div>
</section>
@endif

<section>
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">{{ __('site.locations_eyebrow') }}</p>
      <h2>{{ __('site.locations_title') }}</h2>
    </div>
    <div class="grid-3">
      @foreach ($locations as $i => $loc)
        @php
          $shades = ['#3a5a4d', '#2d4a3d', '#1f4d3d', '#16382c'];
        @endphp
        <div class="location-card" style="background-color:{{ $shades[$i % 4] }}">
          <div class="location-card-content">
            <h3>{{ $loc->name }}</h3>
            <p>{{ $loc->description }}</p>
            <a href="{{ route('location.show', ['locale' => app()->getLocale(), 'location' => $loc->slug]) }}">{{ __('site.book_in') }} {{ $loc->name }} <i class="ti ti-arrow-right"></i></a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section style="background:#fff">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">{{ __('site.how_eyebrow') }}</p>
      <h2>{{ __('site.how_title') }}</h2>
    </div>
    <div class="steps">
      <div class="step">
        <span class="step-num">01</span>
        <h3>{{ __('site.step1_title') }}</h3>
        <p>{{ __('site.step1_text') }}</p>
      </div>
      <div class="step">
        <span class="step-num">02</span>
        <h3>{{ __('site.step2_title') }}</h3>
        <p>{{ __('site.step2_text') }}</p>
      </div>
      <div class="step">
        <span class="step-num">03</span>
        <h3>{{ __('site.step3_title') }}</h3>
        <p>{{ __('site.step3_text') }}</p>
      </div>
      <div class="step">
        <span class="step-num">04</span>
        <h3>{{ __('site.step4_title') }}</h3>
        <p>{{ __('site.step4_text') }}</p>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="cta-band">
      <h2>{{ __('site.cta_ready_title') }}</h2>
      <p>{{ __('site.cta_ready_text') }}</p>
      <div class="hero-cta">
        <a href="{{ route('fleet', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">{{ __('site.view_fleet') }}</a>
        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-light">{{ __('site.contact_us') }}</a>
      </div>
    </div>
  </div>
</section>

</x-layout>
