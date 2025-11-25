@extends('layouts.app')

@section('title', '商品購入')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endpush

@section('content')
<div class="purchase-page">

    <div class="purchase-main">

        <div class="purchase-item-header">
            <div class="purchase-item-image-block">
                
                <div class="purchase-show-image-wrapper">
                    @if ($item->image_path)
                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                    @else
                        <span>No Image</span>
                    @endif
                </div>
            </div>

            <div class="purchase-item-info">
                <h1 class="purchase-item-name">{{ $item->name }}</h1>
                <p class="purchase-item-price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>

        {{-- 支払い方法・配送先フォーム --}}
        <form id="purchase-form"
              class="purchase-form"
              action="{{ route('purchase.store', $item) }}"
              method="POST">
            @csrf

            {{-- 支払い方法 --}}
            <div class="purchase-section">
                <p class="purchase-section-label">支払い方法</p>
                <div class="purchase-section-body">
                    <select name="payment_method" class="purchase-select">
                        <option value="1" selected>コンビニ払い</option>
                        <option value="2" selected>カード払い</option>
                    </select>
                </div>
            </div>

            {{-- 配送先 --}}
            <div class="purchase-section">
                <p class="purchase-section-label">配送先</p>
                <div class="purchase-section-body">
                    <p class="purchase-address-zip">〒{{ $shippingAddress['postal_code'] }}</p>
                    <p class="purchase-address-text">
                        {{ $shippingAddress['address'] }}
                        @if (!empty($shippingAddress['building']))
                        {{ ' ' . $shippingAddress['building'] }}
                        @endif
                    </p>
                    <a href="#" class="purchase-address-edit">変更する</a>
                </div>
            </div>

        </form>
    </div>

    {{-- 右側：金額サマリー＆購入ボタン --}}
    <aside class="purchase-summary">
        <div class="purchase-summary-card">

            <div class="purchase-summary-row">
                <span class="purchase-summary-label">商品代金</span>
                <span class="purchase-summary-value">¥{{ number_format($item->price) }}</span>
            </div>

            <div class="purchase-summary-row">
                <span class="purchase-summary-label">支払い方法</span>
                <span class="purchase-summary-value">コンビニ払い</span>
            </div>

            <button form="purchase-form"
                    type="submit"
                    class="purchase-submit-button">
                購入する
            </button>
        </div>
    </aside>

</div>
@endsection
