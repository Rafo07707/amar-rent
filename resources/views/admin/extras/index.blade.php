<x-admin-layout :title="__('admin.extras')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.extras') }}</h1>
  </div>
  <a href="{{ route('admin.extras.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> {{ __('admin.add_new') }}</a>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.extra_name') }} (HY)</th>
          <th>{{ __('admin.extra_price') }}</th>
          <th>{{ __('admin.extra_pricing_type') }}</th>
          <th>{{ __('admin.car_sort_order') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($extras as $extra)
          <tr>
            <td><i class="{{ $extra->icon }}"></i> {{ $extra->getTranslation('name', 'hy') }} <span style="opacity:0.5;">/ {{ $extra->getTranslation('name', 'en') }}</span></td>
            <td>{{ number_format($extra->price, 0) }} {{ $extra->currency }}</td>
            <td><span class="tag">{{ __('admin.pricing_' . $extra->pricing_type) }}</span></td>
            <td>{{ $extra->sort_order }}</td>
            <td>
              @if ($extra->is_active)
                <span class="status-pill status-confirmed">{{ __('admin.active') }}</span>
              @else
                <span class="status-pill status-cancelled">{{ __('admin.inactive') }}</span>
              @endif
            </td>
            <td class="actions-cell">
              <a href="{{ route('admin.extras.edit', $extra) }}" class="btn btn-outline btn-sm"><i class="ti ti-edit"></i></a>
              <form method="POST" action="{{ route('admin.extras.destroy', $extra) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6">—</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</x-admin-layout>
