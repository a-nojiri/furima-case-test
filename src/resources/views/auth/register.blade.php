@extends('layouts.register_login')

@section('title', '会員登録')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="container">
    <h1 class="register__title">会員登録</h1>

    <form action="{{ route('register') }}" method="POST" class="register__form">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">ユーザー名</label>
            <input id="name" name="name" type="text" class="form-input"
                   value="{{ old('name') }}" autocomplete="name">
            @error('name') <p class="error" role="alert">{{$message}}</p> @enderror     
        </div>

        <div class="form-group">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" name="email" type="email" class="form-input"
                   value="{{ old('email') }}" autocomplete="email">
            @error('email') <p class="error" role="alert">{{ $message }}</p> @enderror       
        </div>

        <div class="form-group">
            <label for="password" class="form-label">パスワード</label>
            <input id="password" name="password" type="password" class="form-input"
                   autocomplete="new-password">
            @error('password') <p class="error" role="alert">{{ $message }}</p> @enderror       
        </div>

        <div class="form-group">
          <label for="password_confirmation" class="form-label">確認用パスワード</label>
          <input id="password_confirmation" name="password_confirmation" type="password" class="form-input"
             autocomplete="new-password">
          @error('password_confirmation') <p class="error" role="alert">{{ $message }}</p> @enderror       
        </div>

        
        <button type="submit" class="btn btn--red" type="submit">登録する</button>

        <p class="register__footer">
            <a href="{{ route('login') }}" class="link--blue">ログインはこちら</a>
        </p>
    </form>
</div>
@endsection
