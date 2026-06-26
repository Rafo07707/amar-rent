<x-admin-layout :title="__('admin.cars')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.cars') }}</h1>
  </div>
  <a href="{{ route('admin.cars.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> {{ __('admin.add_new') }}</a>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.car_image') }}</th>
          <th>{{ __('admin.car_name') }}</th>
          <th>{{ __('admin.car_category') }}</th>
          <th>{{ __('admin.car_price') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.featured') }}</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($cars as $car)
          <tr>
            <td>
              @if ($car->image)
                <img class="thumb" src="{{ $car->image_url }}" alt="">
              @else
                <div class="thumb"><i class="ti ti-car"></i></div>
              @endif
            </td>
            <td>{{ $car->getTranslation('name', 'hy') }} <span style="opacity:0.5;">/ {{ $car->getTranslation('name', 'en') }}</span></td>
            <td><span class="tag">{{ __('site.category_' . $car->category) }}</span></td>
            <td>{{ number_format($car->price_per_day, 0) }} {{ $car->currency }}</td>
            <td>
              @if ($car->is_active)
                <span class="status-pill status-confirmed">{{ __('admin.active') }}</span>
              @else
                <span class="status-pill status-cancelled">{{ __('admin.inactive') }}</span>
              @endif
            </td>
            <td>{{ $car->is_featured ? __('admin.yes') : __('admin.no') }}</td>
            <td class="actions-cell">
              <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-outline btn-sm"><i class="ti ti-edit"></i></a>
              <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7">{{ __('admin.no_cars_found') }}</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="pagination-wrap">{{ $cars->links() }}</div>

</x-admin-layout>
