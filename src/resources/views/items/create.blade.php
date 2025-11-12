@extends('layouts.app')

@section('content')
<div class="container" style="max-width:720px;margin:0 auto;">
  <h1 class="mb-4">商品を出品する</h1>

  <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- タイトル --}}
    <div class="mb-3">
      <label for="title">タイトル</label>
      <input id="title" type="text" name="title" value="{{ old('title') }}">
      @error('title')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 説明 --}}
    <div class="mb-3">
      <label for="description">説明</label>
      <textarea id="description" name="description" rows="5">{{ old('description') }}</textarea>
      @error('description')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 価格 --}}
    <div class="mb-3">
      <label for="price">価格</label>
      <input id="price" type="number" name="price" value="{{ old('price') }}" min="0" step="1">
      @error('price')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 商品の状態（config/const.php を参照） --}}
    @php
        $labels = config('item.condition_labels'); // [数値 => ラベル]
        $current = old('condition');
    @endphp
    <div class="mb-3">
      <label for="condition">商品の状態</label>
      <select id="condition" name="condition">
        <option value="">選択してください</option>
        @if (is_array($labels))
          @foreach ($labels as $value => $text)
            @php
              $selected = '';
              if ($current !== null && (string)$current === (string)$value) {
                  $selected = 'selected';
              }
            @endphp
            <option value="{{ $value }}" {{ $selected }}>{{ $text }}</option>
          @endforeach
        @endif
      </select>
      @error('condition')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    {{-- 画像（任意） --}}
    <div class="mb-4">
      <label for="image">商品画像</label>
      <input id="image" type="file" name="image">
      @error('image')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">出品する</button>
  </form>
</div>
@endsection
