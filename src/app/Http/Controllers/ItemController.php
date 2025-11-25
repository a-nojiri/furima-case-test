<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Http\Requests\CommentRequest;

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

        if ($request->filled('q')) {
            $keyword = trim($request->q);
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        if ($tab === 'mylist' && auth()->check()) {
            $query->whereHas('likes', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }
        
       $items = $query->paginate(12)->withQueryString();
       
        return view('items.index', compact('items', 'tab'));
    }

    public function show(Item $item)
    {
        $item->load([
            'user',
            'categories',
            'comments.user',
            'likes',
        ]);
        
        $likesCount = $item->likes()->count();
        $comments =  $item->comments;
        $isLiked = false;
        if (auth()->check()) {
            $isLiked = $item->likes()
                            ->where('user_id', auth()->id())
                            ->exists();
        }
        

        return view('items.show', [
            'item'       => $item,
            'likesCount' => $likesCount,
            'comments'   => $comments,
            'isLiked'    => $isLiked,
        ]);
    }

     public function like(Item $item)
    {
        $user = Auth::user();
        $already = $item->likes()
                        ->where('user_id', $user->id)
                        ->exists();

        if (!$already) {
            $item->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        else {
           $item->likes()
                ->where('user_id', $user->id)
                ->delete();
        } 

        return redirect()->route('items.show', $item);
    }

    public function storeComment(CommentRequest $request, Item $item)
    {
        $item->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->body,
        ]);

        return redirect()->route('items.show' , $item);
    }
}
