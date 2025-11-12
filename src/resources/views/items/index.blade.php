@extends('layouts.app')
@section('title', '商品一覧')

@section('content')
  @php
    $isMylist  = request('tab') === 'mylist';
    $loggedIn  = auth()->check();
    $activeTab = !$loggedIn ? 'osusume' : ($isMylist ? 'mylist' : 'osusume');
  @endphp

  <div style="border-bottom:2px solid #111; margin:8px 0 24px;">
    <nav style="display:flex; gap:24px; align-items:flex-end; padding:12px 0;">
      <a href="{{ url('/') }}"
         style="text-decoration:none; font-weight:800; font-size:14px; padding-bottom:8px; color:{{ $activeTab==='osusume' ? '#ef4444' : '#111' }};">
        おすすめ
      </a>
      
      <a href="{{ url('/?tab=mylist') }}"
         style="text-decoration:none; font-weight:800; font-size:14px; padding-bottom:8px; color:{{ $activeTab==='mylist' ? '#ef4444' : '#111' }};">
        マイリスト
      </a>
    </nav>
  </div>

  @if ($items->count())
    <ul style="list-style:none; margin:0; padding:0; display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap:24px;">
      @foreach ($items as $item)
        <li style="border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; background:#fff;">
          <a href="{{ url('/item/'.$item->id) }}" style="display:block; color:#111; text-decoration:none;">
            <figure style="position:relative; aspect-ratio:1/1; background:#f7f7f7; margin:0;">
              @php
                $path = $item->image_path;
              @endphp

              @if ($path)
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}"
                     style="width:100%; height:100%; object-fit:cover; display:block;">
              @else
                <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; color:#666; font-size:12px;">
                  No Image
                </div>
              @endif

              @if (($item->is_sold ?? 0) > 0)
                <span style="position:absolute; top:8px; left:8px; background:#111; color:#fff; font-size:12px; padding:4px 8px; border-radius:9999px;">
                  Sold
                </span>
              @endif
            </figure>
            
            <div style="font-size:12px; padding:6px 8px;">
              {{ $item->name }}</div>
          </a>
        </li>
      @endforeach
    </ul>

    <div style="margin:16px 0;">
      {{ $items->links() }}
    </div>
  @endif
@endsection
