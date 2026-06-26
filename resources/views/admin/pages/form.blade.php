<x-admin-layout :title="$page->slug">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.edit') }} — {{ $page->slug }}</h1>
  </div>
  <a href="{{ route('admin.pages.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<form method="POST" action="{{ route('admin.pages.update', $page) }}">
  @csrf
  @method('PUT')

  <div class="admin-card">
    <div class="lang-tabs">
      @foreach ($locales as $i => $loc)
        <button type="button" class="lang-tab-btn {{ $i === 0 ? 'active' : '' }}" data-lang-tab="{{ $loc }}">{{ __('admin.lang_' . $loc) }}</button>
      @endforeach
    </div>

    @foreach ($locales as $i => $loc)
      <div class="lang-tab-panel {{ $i === 0 ? 'active' : '' }}" data-lang-panel="{{ $loc }}">
        <div class="form-group">
          <label>{{ __('admin.page_title_field') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="title[{{ $loc }}]" value="{{ old("title.$loc", $page->getTranslation('title', $loc)) }}">
        </div>
        <div class="form-group">
          <label>{{ __('admin.page_content') }} ({{ __('admin.lang_' . $loc) }})</label>
          <textarea name="content[{{ $loc }}]" rows="10">{{ old("content.$loc", $page->getTranslation('content', $loc)) }}</textarea>
        </div>
        <div class="form-group">
          <label>{{ __('admin.meta_title') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="meta_title[{{ $loc }}]" value="{{ old("meta_title.$loc", $page->getTranslation('meta_title', $loc)) }}">
        </div>
        <div class="form-group">
          <label>{{ __('admin.meta_description') }} ({{ __('admin.lang_' . $loc) }})</label>
          <textarea name="meta_description[{{ $loc }}]" rows="2">{{ old("meta_description.$loc", $page->getTranslation('meta_description', $loc)) }}</textarea>
        </div>
      </div>
    @endforeach
  </div>

  <button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> {{ __('admin.save') }}</button>
</form>

@push('scripts')
<script>
  document.querySelectorAll('[data-lang-tab]').forEach(btn => {
    btn.addEventListener('click', () => {
      const lang = btn.dataset.langTab;
      document.querySelectorAll('[data-lang-tab]').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('[data-lang-panel]').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      document.querySelector(`[data-lang-panel="${lang}"]`).classList.add('active');
    });
  });
</script>
@endpush

</x-admin-layout>
