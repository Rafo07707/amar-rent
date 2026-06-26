<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('admin.login_title') }} | Amar Rent Car</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>

<div class="login-wrap">
  <div class="login-card">
    <div class="login-logo"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="12" cy="12" r="4.5" fill="currentColor"/><line x1="12" y1="2" x2="12" y2="4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="12" y1="19.5" x2="12" y2="22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="2" y1="12" x2="4.5" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="19.5" y1="12" x2="22" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg> Amar Admin</div>

    @if ($errors->any())
      <div class="admin-alert admin-alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
      @csrf
      <div class="form-group">
        <label for="email">{{ __('admin.email') }}</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">{{ __('admin.password') }}</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group checkbox-inline">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember" style="margin:0;">{{ __('admin.remember_me') }}</label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">{{ __('admin.login') }}</button>
    </form>
  </div>
</div>

</body>
</html>
