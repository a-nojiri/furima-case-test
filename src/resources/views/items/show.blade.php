@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/item-show.css') }}">
@endpush

@section('title', $item->name . '|商品詳細')

@section('content')
<div class="item-show">

    <div class="item-show-left">
        <div class="item-show-image-wrapper">
            @if($item->image_path)
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
            @else
                <span>商品画像</span>
            @endif
        </div>
    </div>

    <div class="item-show-right">
        
        <h1 class="item-show-name">
            {{ $item->name }}
        </h1>

        @if(!empty($item->brand))
            <p class="item-show-brand">
                {{$item->brand}}
            </p>    
        @endif

        <p class="item-show-price">
            ¥{{ number_format($item->price) }}（税込）
        </p>

        <div class="item-show-meta">
            <form action="{{ route('items.like', $item) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    class="item-show-like-button {{ $isLiked ? 'item-show-like-button--active' : '' }}">
                    {{ $isLiked ? '❤️' : '♡' }} {{ $likesCount }}
                </button>
            </form>
            <div>💬 {{ count($comments) }}</div>
        </div>

        <div class="item-show-purchase">
            <a href="{{ route('purchase.show', $item->id) }}" class="item-show-purchase-button">
                購入手続きへ
            </a>    
        </div>

        <div class="item-show-section">
            <h2 class="item-show-section-title">商品説明</h2>
            <p class="item-show-description">
                {{ $item->description }}
            </p>
        </div>

        <div class="item-show-section">
            <h2 class="item-show-section-title">商品の情報</h2>
            <p class="item-show-info-row">
                カテゴリー：
        @if($item->categories->count() > 0)
            @foreach($item->categories as $category)
                {{ $category->name }}
                @if(!$loop->last) / @endif
            @endforeach
        @else
            未分類
        @endif</p>
            <p class="item-show-info-row">商品の状態：{{ $item->condition_label ?? '' }}</p>
        </div>
        
        <div class="item-show-comments-wrapper">
            <h2 class="item-show-comments-title">
                コメント（{{ count($comments) }}）
            </h2>

            {{-- コメント一覧 --}}
            @foreach($comments as $comment)
                <div class="item-show-comment">
                    <div class="item-show-comment-header">
                        <div class="item-show-avatar"></div>
                        <span class="item-show-comment-user">{{ $comment->user->name }}</span>
                    </div>
                    <div class="item-show-comment-body">
                        {{ $comment->body }}
                    </div>
                </div>
            @endforeach

            {{-- 商品へのコメント --}}
            <div class="item-show-comment-form">
                <h3 class="item-show-comment-form-title">商品へのコメント</h3>

                <form method="POST" action="{{ route('items.comments.store', $item) }}">
                    @csrf
                    <textarea
                        name="body"
                        placeholder="こちらにコメントを入力します。"
                        class="item-show-comment-textarea">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="item-show-error-message">{{ $message }}</p>
                    @enderror

                   <button
                       type="submit"
                       class="item-show-comment-submit">
                       コメントを送信する
                   </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
