@php
  $locale = app()->getLocale();
@endphp
<x-layout
  :meta-title="$page?->getTranslation('meta_title') ?: $page?->getTranslation('title')"
  :meta-description="$page?->getTranslation('meta_description')"
>

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ $page?->getTranslation('title') }}</span></div>
    <h1>{{ $page?->getTranslation('title') }}</h1>
  </div>
</div>

<section>
  <div class="container">
    <div class="legal-content">
      {!! $page?->getTranslation('content') !!}
    </div>
  </div>
</section>

</x-layout>
