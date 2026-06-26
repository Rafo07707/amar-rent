@php
  $isEdit = $extra->exists;
@endphp
<x-admin-layout :title="$isEdit ? __('admin.edit') : __('admin.add_new')">

<div class="admin-header">
  <div>
    <h1>{{ $isEdit ? __('admin.edit') : __('admin.add_new') }} — {{ __('admin.extras') }}</h1>
  </div>
  <a href="{{ route('admin.extras.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<form method="POST" action="{{ $isEdit ? route('admin.extras.update', $extra) : route('admin.extras.store') }}">
  @csrf
  @if ($isEdit) @method('PUT') @endif

  <div class="admin-card">
    <h3 style="margin-bottom:16px; font-size:1rem;">{{ __('admin.translations_for') }}</h3>
    <div class="lang-tabs">
      @foreach ($locales as $i => $loc)
        <button type="button" class="lang-tab-btn {{ $i === 0 ? 'active' : '' }}" data-lang-tab="{{ $loc }}">{{ __('admin.lang_' . $loc) }}</button>
      @endforeach
    </div>

    @foreach ($locales as $i => $loc)
      <div class="lang-tab-panel {{ $i === 0 ? 'active' : '' }}" data-lang-panel="{{ $loc }}">
        <div class="form-group">
          <label>{{ __('admin.extra_name') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="name[{{ $loc }}]" value="{{ old("name.$loc", $extra->getTranslation('name', $loc)) }}">
        </div>
        <div class="form-group">
          <label>{{ __('admin.extra_description') }} ({{ __('admin.lang_' . $loc) }})</label>
          <textarea name="description[{{ $loc }}]" rows="2">{{ old("description.$loc", $extra->getTranslation('description', $loc)) }}</textarea>
        </div>
      </div>
    @endforeach
  </div>

  <div class="admin-card">
    <div class="form-grid">
      <div class="form-group">
        <label>{{ __('admin.extra_price') }}</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $extra->price ?? 0) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_currency') }}</label>
        <input type="text" name="currency" value="{{ old('currency', $extra->currency ?: 'AMD') }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.extra_pricing_type') }}</label>
        <select name="pricing_type">
          <option value="flat" {{ old('pricing_type', $extra->pricing_type ?? 'flat') === 'flat' ? 'selected' : '' }}>{{ __('admin.pricing_flat') }}</option>
          <option value="per_day" {{ old('pricing_type', $extra->pricing_type ?? '') === 'per_day' ? 'selected' : '' }}>{{ __('admin.pricing_per_day') }}</option>
        </select>
      </div>
      <div class="form-group">
        <label>{{ __('admin.extra_icon') }}</label>
        <input type="text" name="icon" value="{{ old('icon', $extra->icon ?: 'ti-plus') }}" placeholder="ti-gas-station">
      </div>
      <div class="form-group">
        <label>{{ __('admin.extra_key') }}</label>
        <input type="text" name="key" value="{{ old('key', $extra->key) }}" placeholder="auto-generated if left empty">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $extra->sort_order ?: 0) }}">
      </div>
    </div>
    <label class="checkbox-inline">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $isEdit ? $extra->is_active : true) ? 'checked' : '' }}>
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
