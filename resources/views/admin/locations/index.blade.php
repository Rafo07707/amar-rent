<x-admin-layout :title="__('admin.locations')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.locations') }}</h1>
  </div>
  <a href="{{ route('admin.locations.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> {{ __('admin.add_new') }}</a>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.location_name') }}</th>
          <th>{{ __('admin.location_address') }}</th>
          <th>{{ __('admin.car_sort_order') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($locations as $location)
          <tr>
            <td><i class="{{ $location->icon }}"></i> {{ $location->getTranslation('name', 'hy') }} <span style="opacity:0.5;">/ {{ $location->getTranslation('name', 'en') }}</span></td>
            <td>{{ $location->getTranslation('address', 'hy') }}</td>
            <td>{{ $location->sort_order }}</td>
            <td>
              @if ($location->is_active)
                <span class="status-pill status-confirmed">{{ __('admin.active') }}</span>
              @else
                <span class="status-pill status-cancelled">{{ __('admin.inactive') }}</span>
              @endif
            </td>
            <td class="actions-cell">
              <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-outline btn-sm"><i class="ti ti-edit"></i></a>
              <form method="POST" action="{{ route('admin.locations.destroy', $location) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">—</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</x-admin-layout>
