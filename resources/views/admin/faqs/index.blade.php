<x-admin-layout :title="__('admin.faqs')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.faqs') }}</h1>
  </div>
  <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> {{ __('admin.add_new') }}</a>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.faq_question') }} (HY)</th>
          <th>{{ __('admin.car_sort_order') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($faqs as $faq)
          <tr>
            <td>{{ $faq->getTranslation('question', 'hy') }}</td>
            <td>{{ $faq->sort_order }}</td>
            <td>
              @if ($faq->is_active)
                <span class="status-pill status-confirmed">{{ __('admin.active') }}</span>
              @else
                <span class="status-pill status-cancelled">{{ __('admin.inactive') }}</span>
              @endif
            </td>
            <td class="actions-cell">
              <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-outline btn-sm"><i class="ti ti-edit"></i></a>
              <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4">—</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</x-admin-layout>
