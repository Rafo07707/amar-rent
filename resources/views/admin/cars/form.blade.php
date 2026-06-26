@php
  $isEdit = $car->exists;
@endphp
<x-admin-layout :title="$isEdit ? __('admin.edit') : __('admin.add_new')">

<div class="admin-header">
  <div>
    <h1>{{ $isEdit ? __('admin.edit') : __('admin.add_new') }} — {{ __('admin.cars') }}</h1>
  </div>
  <a href="{{ route('admin.cars.index') }}" class="btn btn-outline"><i class="ti ti-arrow-left"></i> {{ __('admin.back') }}</a>
</div>

<form method="POST" action="{{ $isEdit ? route('admin.cars.update', $car) : route('admin.cars.store') }}" enctype="multipart/form-data">
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
          <label>{{ __('admin.car_name') }} ({{ __('admin.lang_' . $loc) }})</label>
          <input type="text" name="name[{{ $loc }}]" value="{{ old("name.$loc", $car->getTranslation('name', $loc)) }}">
        </div>
        <div class="form-group">
          <label>{{ __('site.description') ?? 'Description' }} ({{ __('admin.lang_' . $loc) }})</label>
          <textarea name="description[{{ $loc }}]" rows="3">{{ old("description.$loc", $car->getTranslation('description', $loc)) }}</textarea>
        </div>
      </div>
    @endforeach
  </div>

  <div class="admin-card">
    <div class="form-grid">
      <div class="form-group">
        <label>{{ __('admin.car_category') }}</label>
        <select name="category">
          @foreach (['compact', 'sedan', 'suv', 'premium'] as $cat)
            <option value="{{ $cat }}" {{ old('category', $car->category) === $cat ? 'selected' : '' }}>{{ __('site.category_' . $cat) }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_transmission') }}</label>
        <select name="transmission">
          @foreach (['automatic', 'manual'] as $t)
            <option value="{{ $t }}" {{ old('transmission', $car->transmission) === $t ? 'selected' : '' }}>{{ __('site.transmission_' . $t) }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_fuel') }}</label>
        <select name="fuel_type">
          @foreach (['petrol', 'diesel', 'hybrid', 'electric'] as $f)
            <option value="{{ $f }}" {{ old('fuel_type', $car->fuel_type) === $f ? 'selected' : '' }}>{{ __('site.fuel_' . $f) }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_seats') }}</label>
        <input type="number" name="seats" min="1" max="9" value="{{ old('seats', $car->seats ?: 5) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_bags') }}</label>
        <input type="number" name="bags" min="0" max="9" value="{{ old('bags', $car->bags ?? 2) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_price') }}</label>
        <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_deposit') }}</label>
        <input type="number" step="0.01" name="deposit_amount" value="{{ old('deposit_amount', $car->deposit_amount ?? 0) }}">
        <p class="form-hint">{{ __('admin.car_deposit_hint') }}</p>
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_included_km') }}</label>
        <input type="number" name="included_km_per_day" value="{{ old('included_km_per_day', $car->included_km_per_day ?? 0) }}">
        <p class="form-hint">{{ __('admin.car_included_km_hint') }}</p>
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_currency') }}</label>
        <input type="text" name="currency" value="{{ old('currency', $car->currency ?: 'AMD') }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.car_sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $car->sort_order ?: 0) }}">
      </div>
      <div class="form-group">
        <label>{{ __('admin.page_slug') }}</label>
        <input type="text" name="slug" value="{{ old('slug', $car->slug) }}" placeholder="auto-generated if left empty">
      </div>
    </div>

    <div class="form-group">
      <label>{{ __('admin.upload_image') }}</label>
      <input type="file" name="image" accept="image/*">
      @if ($car->image)
        <p class="form-hint">{{ __('admin.current_image') }}: <img src="{{ $car->image_url }}" alt="{{ $car->name }}" style="height:32px;vertical-align:middle;border-radius:4px;"></p>
      @endif
    </div>

    <div style="display:flex; gap:24px; margin-top:8px;">
      <label class="checkbox-inline">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $isEdit ? $car->is_active : true) ? 'checked' : '' }}>
        {{ __('admin.active') }}
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $car->is_featured) ? 'checked' : '' }}>
        {{ __('admin.featured') }}
      </label>
    </div>
  </div>

  <div class="admin-card">
    <h3 style="margin-bottom:16px; font-size:1rem;">{{ __('admin.car_locations') }}</h3>
    <p class="form-hint" style="margin-bottom:14px;">{{ __('admin.car_locations_hint') }}</p>
    <div style="display:flex; gap:24px; flex-wrap:wrap;">
      @php($assignedLocationIds = old('location_ids', $car->exists ? $car->locations->pluck('id')->all() : []))
      @foreach ($locations as $loc)
        <label class="checkbox-inline">
          <input type="checkbox" name="location_ids[]" value="{{ $loc->id }}" {{ in_array($loc->id, $assignedLocationIds) ? 'checked' : '' }}>
          {{ $loc->name }}
        </label>
      @endforeach
    </div>
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
