<x-admin-layout :title="__('admin.pages')">

<div class="admin-header">
  <div>
    <h1>{{ __('admin.pages') }}</h1>
  </div>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>{{ __('admin.page_slug') }}</th>
          <th>{{ __('admin.page_title_field') }} (HY)</th>
          <th>{{ __('admin.page_title_field') }} (EN)</th>
          <th>{{ __('admin.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pages as $page)
          <tr>
            <td><span class="tag">{{ $page->slug }}</span></td>
            <td>{{ $page->getTranslation('title', 'hy') }}</td>
            <td>{{ $page->getTranslation('title', 'en') }}</td>
            <td class="actions-cell">
              <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline btn-sm"><i class="ti ti-edit"></i> {{ __('admin.edit') }}</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

</x-admin-layout>
