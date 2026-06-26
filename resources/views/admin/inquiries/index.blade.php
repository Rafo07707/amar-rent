<x-admin-layout :title="__('admin.inquiries')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.inquiries') }}</h1>
    <p>{{ __('admin.inquiries_subtitle') }}</p>
  </div>
</div>

<div class="toolbar">
  <div class="filter-pills">
    <a href="{{ route('admin.inquiries.index') }}" class="filter-pill {{ !$status ? 'active' : '' }}">{{ __('admin.all_statuses') }}</a>
    @foreach (['new', 'confirmed', 'completed', 'cancelled'] as $s)
      <a href="{{ route('admin.inquiries.index', ['status' => $s]) }}" class="filter-pill {{ $status === $s ? 'active' : '' }}">{{ __('admin.booking_status_' . $s) }}</a>
    @endforeach
  </div>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.customer') }}</th>
          <th>{{ __('admin.phone') }}</th>
          <th>{{ __('site.email_label') }}</th>
          <th>{{ __('admin.locations') }}</th>
          <th>{{ __('admin.status') }}</th>
          <th>{{ __('admin.created_at') }}</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($inquiries as $inquiry)
          <tr>
            <td>{{ $inquiry->customer_name }}</td>
            <td>{{ $inquiry->customer_phone }}</td>
            <td>{{ $inquiry->customer_email ?: '—' }}</td>
            <td>{{ $inquiry->location?->name ?? '—' }}</td>
            <td><span class="status-pill status-{{ $inquiry->status }}">{{ __('admin.booking_status_' . $inquiry->status) }}</span></td>
            <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
            <td class="actions-cell">
              <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-outline btn-sm"><i class="ti ti-eye"></i></a>
              <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('{{ __('admin.confirm_delete') }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7">—</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="pagination-wrap">{{ $inquiries->links() }}</div>

</x-admin-layout>
