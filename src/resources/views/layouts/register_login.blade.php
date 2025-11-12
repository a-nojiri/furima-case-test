<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'フリマ')</title>

  @stack('styles')
</head>
<body style="margin:0; background:#fff; color:#111;">
  <header style="background:#111; color:#fff;">
    <div style="width:100px; padding:12px 0; display:flex; align-items:center;">

      {{-- ロゴ（全ページ共通） --}}
      <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; text-decoration:none;">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" width="300" height="40" loading="lazy" style="display:block;">
      </a>
    </div>
  </header>

  <main style="max-width:760px; margin:32px auto; padding:0 12px;">
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>