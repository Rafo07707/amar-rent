@php
  $locale = app()->getLocale();
  $whatsapp = \App\Models\Setting::get('site_whatsapp', '37433123456');
@endphp
<x-layout
  :meta-title="$page?->getTranslation('meta_title') ?: __('site.nav_services')"
  :meta-description="$page?->getTranslation('meta_description')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ __('site.nav_services') }}</span></div>
    <h1>{{ $page?->getTranslation('title') ?: __('site.nav_services') }}</h1>
    <p>{{ $page?->getTranslation('content') }}</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="grid-3">
      <div class="feature-card">
        <div class="icon"><i class="ti ti-shield-check"></i></div>
        <h3>{{ __('site.adv_insurance_title') }}</h3>
        <p>{{ __('site.adv_insurance_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-truck-delivery"></i></div>
        <h3>{{ __('site.adv_delivery_title') }}</h3>
        <p>{{ __('site.adv_delivery_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-headset"></i></div>
        <h3>{{ __('site.adv_support_title') }}</h3>
        <p>{{ __('site.adv_support_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-moon-stars"></i></div>
        <h3>{{ __('site.adv_night_title') }}</h3>
        <p>{{ __('site.adv_night_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-calendar-x"></i></div>
        <h3>{{ __('site.adv_cancel_title') }}</h3>
        <p>{{ __('site.adv_cancel_text') }}</p>
      </div>
      <div class="feature-card">
        <div class="icon"><i class="ti ti-receipt-2"></i></div>
        <h3>{{ __('site.adv_fees_title') }}</h3>
        <p>{{ __('site.adv_fees_text') }}</p>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="cta-band">
      <h2>{{ __('site.faq_not_found_title') }}</h2>
      <p>{{ __('site.faq_not_found_text') }}</p>
      <div class="hero-cta">
        <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn btn-primary">{{ __('site.contact_us') }}</a>
        <a href="https://wa.me/{{ $whatsapp }}" class="btn btn-outline-light"><i class="ti ti-brand-whatsapp"></i> WhatsApp</a>
      </div>
    </div>
  </div>
</section>

</x-layout>
