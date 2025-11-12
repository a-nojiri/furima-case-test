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
    <div style="position:relative; width:100%; padding:10px 16px; min-height:40px;">

      <!-- 左端：ロゴ（常に画面左） -->
      <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; text-decoration:none;">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH"
             width="300" height="40" loading="lazy" style="display:block;">
      </a>

      <div style="
        position:absolute; left:50%; top:50%; transform:translate(-50%, -50%);
        width:100%; max-width:560px; padding:0 12px; box-sizing:border-box; 
        z-index:1;
      ">
        <form action="{{ url('/') }}" method="get" style="display:flex; width:100%;">
          <input type="text" name="q" placeholder="なにをお探しですか？"
                 style="flex:1; height:32px; padding:6px 10px; border:0; border-radius:4px; background:#fff; color:#111; font-size:14px;">
        </form>
      </div>

      <!-- 右端：メニュー（折り返しなし・常に右） -->
      <nav style="
        position:absolute; right:45px; top:50%; transform:translateY(-50%);
        display:flex; align-items:center; gap:12px; white-space:nowrap; z-index:2;
      ">
        @auth
          <form method="POST" action="{{ route('logout') }}" style="margin:0; display:inline;">
            @csrf
            <button type="submit" style="background:none; border:0; color:#fff; cursor:pointer; padding:0;">ログアウト</button>
          </form>
        @else
          <a href="{{ route('login') }}" style="color:#fff; text-decoration:none;">ログイン</a>
          {{-- <a href="{{ route('register') }}" style="color:#fff; text-decoration:none;">会員登録</a> --}}
        @endauth

        <a href="{{ auth()->check() ? url('/mypage') : route('login') }}" style="color:#fff; text-decoration:none;">マイページ</a>
        <a href="{{ auth()->check() ? url('/items/create') : route('login') }}" style="color:#fff; text-decoration:none;">出品</a>
      </nav>
    </div>
  </header>

  <!-- コンテンツ -->
  <main style="max-width:1100px; margin:16px auto; padding:0 12px;">
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>
