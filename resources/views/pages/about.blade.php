@php
  $locale = app()->getLocale();
@endphp
<x-layout
  :meta-title="$page?->getTranslation('meta_title') ?: __('site.nav_about')"
  :meta-description="$page?->getTranslation('meta_description')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ __('site.nav_about') }}</span></div>
    <h1>{{ $page?->getTranslation('title') ?: __('site.nav_about') }}</h1>
  </div>
</div>

<section>
  <div class="container">
    <div class="about-hero">
      <div>
        <p class="eyebrow">{{ __('site.nav_about') }}</p>
        <h2>Amar Rent Car Armenia</h2>
        <div class="lead" style="margin-top:16px; max-width:none;">
          {!! $page?->getTranslation('content') !!}
        </div>
      </div>
      <div class="loc-img" style="height:380px; font-size:5rem;">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" opacity="0.5" aria-hidden="true">
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
      </div>
    </div>
  </div>
</section>

<section style="background:#fff">
  <div class="container">
    <div class="cta-band">
      <h2>{{ __('site.cta_ready_title') }}</h2>
      <p>{{ __('site.cta_ready_text') }}</p>
      <div class="hero-cta">
        <a href="{{ route('fleet', ['locale' => $locale]) }}" class="btn btn-primary">{{ __('site.view_fleet') }}</a>
        <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn btn-outline-light">{{ __('site.contact_us') }}</a>
      </div>
    </div>
  </div>
</section>

</x-layout>
