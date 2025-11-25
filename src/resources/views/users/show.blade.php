@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="mypage">

    <h1>{{ $user->name }} さんのマイページ</h1>

    <nav>
        <a href="{{ route('mypage.show', ['page' => 'sell']) }}"
           style="{{ $tab === 'sell' ? 'font-weight:bold;' : '' }}">
            出品した商品
        </a>

        <a href="{{ route('mypage.show', ['page' => 'buy']) }}"
           style="{{ $tab === 'buy' ? 'font-weight:bold;' : '' }}">
            購入した商品
        </a>
    </nav>

    <hr>
    @if ($tab === 'sell')
        @include('users.selling', ['items' => $sellingItems])
    @else
        @include('users.purchase', ['items' => $purchasedItems])
    @endif
</div>
@endsection
