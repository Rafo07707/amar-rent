@php
  $isEdit = $faq->exists;
@endphp
<x-admin-layout :title="$isEdit ? __('admin.edit') : __('admin.add_new')">

<div class="admin-header">
  <div>
    <h1>{{ $isEdit ? __('admin.edit') : __('admin.add_new') }} — {{ __('admin.faqs') }}</h1>
  </div>
  <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<form method="POST" action="{{ $isEdit ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
  @csrf
  @if ($isEdit) @method('PUT') @endif

  <div class="admin-card">
    <div class="lang-tabs">
      @foreach ($locales as $i => $loc)
        <button type="button" class="lang-tab-btn {{ $i === 0 ? 'active' : '' }}" data-lang-tab="{{ $loc }}">{{ __('admin.lang_' . $loc) }}</button>
      @endforeach
    </div>

    @foreach ($locales as $i => $loc)
      <div class="lang-tab-panel {{ $i === 0 ? 'active' : '' }}" data-lang-panel="{{ $loc }}">
        <div class="form-group">
          <label>{{ __('admin.faq_question') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="question[{{ $loc }}]" value="{{ old("question.$loc", $faq->getTranslation('question', $loc)) }}">
        </div>
        <div class="form-group">
          <label>{{ __('admin.faq_answer') }} ({{ __('admin.lang_' . $loc) }})</label>
          <textarea name="answer[{{ $loc }}]" rows="3">{{ old("answer.$loc", $faq->getTranslation('answer', $loc)) }}</textarea>
        </div>
      </div>
    @endforeach
  </div>

  <div class="admin-card">
    <div class="form-grid">
      <div class="form-group">
        <label>{{ __('admin.car_sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?: 0) }}">
      </div>
    </div>
    <label class="checkbox-inline">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $isEdit ? $faq->is_active : true) ? 'checked' : '' }}>
      {{ __('admin.active') }}
    </label>
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
