<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function show(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('page', 'sell');

        if ($tab === 'buy') {
            $purchasedItems = $user->purchasedItems()
                ->latest('orders.created_at')
                ->paginate(12);

            $sellingItems = collect(); 
        } else {
            $sellingItems = $user->sellingItems()
                ->latest()
                ->paginate(12);

            $purchasedItems = collect();
        }

        return view('users.show', compact('user', 'tab', 'sellingItems', 'purchasedItems'));
    }

    public function edit()
    {
        return view('users.edit');
    }

    public function update(Request $request)
    {
        return back();
    }
}
