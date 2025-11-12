@extends('layouts.register_login')
@section('title','ログイン')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
@endpush

@section('content')
<div class="container" style="max-width:480px; margin:80px auto;">
  <h1 class="login__title">ログイン</h1>

  <form method="POST" action="{{ route('login') }}" class="login__form">
    @csrf

    <div class="form-group">
      <label for="email" class="form-label">メールアドレス</label>
      <input id="email" type="email" name="email" class="form-input"
             value="{{ old('email') }}" autocomplete="email" autofocus>
      @error('email') <p class="error" role="alert">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
      <label for="password" class="form-label">パスワード</label>
      <input id="password" type="password" name="password" class="form-input"
             autocomplete="current-password">
      @error('password') <p class="error" role="alert">{{ $message }}</p> @enderror
    </div>

    <div class="form-check">
      <input id="remember" type="checkbox" name="remember">
      <label for="remember">ログイン状態を保持する</label>
    </div>

    <button class="btn btn--red" type="submit">ログイン</button>

    <p class="login__footer">
      <a class="link--blue" href="{{ route('register') }}">会員登録はこちら</a>
    </p>
  </form>
</div>
@endsection
