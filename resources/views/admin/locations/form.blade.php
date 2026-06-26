@php
  $isEdit = $location->exists;
@endphp
<x-admin-layout :title="$isEdit ? __('admin.edit') : __('admin.add_new')">

<div class="admin-header">
  <div>
    <h1>{{ $isEdit ? __('admin.edit') : __('admin.add_new') }} — {{ __('admin.locations') }}</h1>
  </div>
  <a href="{{ route('admin.locations.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<form method="POST" action="{{ $isEdit ? route('admin.locations.update', $location) : route('admin.locations.store') }}">
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
          <label>{{ __('admin.location_name') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="name[{{ $loc }}]" value="{{ old("name.$loc", $location->getTranslation('name', $loc)) }}">
        </div>
        <div class="form-group">
          <textarea name="description[{{ $loc }}]" rows="2" placeholder="Description">{{ old("description.$loc", $location->getTranslation('description', $loc)) }}</textarea>
        </div>
        <div class="form-group">
          <label>{{ __('admin.location_address') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="address[{{ $loc }}]" value="{{ old("address.$loc", $location->getTranslation('address', $loc)) }}">
        </div>
        <div class="form-group">
          <label>{{ __('admin.location_hours') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="working_hours[{{ $loc }}]" value="{{ old("working_hours.$loc", $location->getTranslation('working_hours', $loc)) }}">
        </div>
      </div>
    @endforeach
  </div>

  <div class="admin-card">
    <div class="form-grid">
      <div class="form-group">
        <label>{{ __('admin.location_icon') }}</label>
        <input type="text" name="icon" value="{{ old('icon', $location->icon ?: 'ti-map-pin') }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.page_slug') }}</label>
        <input type="text" name="slug" value="{{ old('slug', $location->slug) }}" placeholder="auto-generated if left empty">
      </div>
      <div class="form-group">
        <label>{{ __('admin.location_lat') }}</label>
        <input type="text" name="latitude" value="{{ old('latitude', $location->latitude) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.location_lng') }}</label>
        <input type="text" name="longitude" value="{{ old('longitude', $location->longitude) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $location->sort_order ?: 0) }}">
      </div>
    </div>
    <label class="checkbox-inline">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $isEdit ? $location->is_active : true) ? 'checked' : '' }}>
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
