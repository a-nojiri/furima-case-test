@extends('layouts.app')
@section('title', '商品一覧')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endpush

@section('content')
  @php
    $isMylist  = request('tab') === 'mylist';
    $loggedIn  = auth()->check();
    $activeTab = !$loggedIn ? 'osusume' : ($isMylist ? 'mylist' : 'osusume');
  @endphp

  {{-- タブ --}}
  <nav class="tabs">
    <a href="{{ url('/') }}"
       class="tab {{ $activeTab === 'osusume' ? 'is-active' : '' }}">
      おすすめ
    </a>
    
    <a href="{{ url('/?tab=mylist') }}"
       class="tab {{ $activeTab === 'mylist' ? 'is-active' : '' }}">
      マイリスト
    </a>
  </nav>

  @if ($items->count())
    <ul class="items-grid">
      @foreach ($items as $item)
        <li class="item-card">
          <a href="{{ url('/item/'.$item->id) }}" class="item-link">
            <figure class="thumb">
              @php
                $path = $item->image_path;
              @endphp

              @if ($path)
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
              @else
                <div class="no-image">
                  No Image
                </div>
              @endif

              @if (($item->is_sold ?? 0) > 0)
                <span class="badge-sold">
                  Sold
                </span>
              @endif
            </figure>
            
            <div class="item-name">
              {{ $item->name }}
            </div>
          </a>
        </li>
      @endforeach
    </ul>

    <div class="pager">
      {{ $items->links() }}
    </div>
  @endif
@endsection
