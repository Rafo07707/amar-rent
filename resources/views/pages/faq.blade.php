@php
  $locale = app()->getLocale();
  $whatsapp = \App\Models\Setting::get('site_whatsapp', '37433123456');
@endphp
<x-layout
  :meta-title="$page?->getTranslation('meta_title') ?: __('site.faq_title')"
  :meta-description="$page?->getTranslation('meta_description')"
>

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach ($faqs as $faq)
    {
      "@type": "Question",
      "name": "{{ str_replace('"', "'", $faq->question) }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ str_replace('"', "'", $faq->answer) }}"
      }
    }@if (!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endpush

<div class="page-header">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav_home') }}</a> / <span>{{ __('site.nav_faq') }}</span></div>
    <h1>{{ __('site.faq_title') }}</h1>
    <p>{{ __('site.faq_subtitle') }}</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="faq-list">
      @foreach ($faqs as $faq)
        <div class="faq-item">
          <div class="faq-question">{{ $faq->question }}<i class="ti ti-chevron-down chevron"></i></div>
          <div class="faq-answer"><div class="faq-answer-inner">{{ $faq->answer }}</div></div>
        </div>
      @endforeach
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
        <a href="https://wa.me/{{ $whatsapp }}" class="btn btn-outline-light"><i class="ti ti-brand-whatsapp"></i> WhatsApp</a>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  document.querySelectorAll('.faq-item').forEach(item => {
    const question = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');
    question.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('open');
        i.querySelector('.faq-answer').style.maxHeight = null;
      });
      if (!isOpen) {
        item.classList.add('open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
      }
    });
  });
</script>
@endpush

</x-layout>
