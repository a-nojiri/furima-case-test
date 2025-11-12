<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');

        if ($tab === 'mylist' && !auth()->check()) {
           
            return redirect()->guest(route('login'));
        }

        $query = Item::query()
            ->latest()
            ->withCount('order as is_sold');

        //自分の出品は除外（ログイン時のみ）
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        } 
        
       $items = $query->paginate(12)->withQueryString();
       
        return view('items.index', compact('items', 'tab'));
    }
}
