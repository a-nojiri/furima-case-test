@if ($items->count())
    <ul>
        @foreach ($items as $item)
            <li>
                <a href="/item/{{ $item->id }}">
                    {{ $item->name }} / ¥{{ number_format($item->price) }}
                </a>
            </li>
        @endforeach
    </ul>

    {{ $items->links() }}
@else
    <p>出品した商品はありません。</p>
@endif
