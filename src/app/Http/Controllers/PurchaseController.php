<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Address;


class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user     = Auth::user();
        $profile  = $user->profile;

        $shippingAddress =[
            'postal_code' => $profile?->postal_code,
            'address'     => $profile?->address,
            'building'    => $profile?->building,
        ];
        
         return view('purchase.show', compact('item', 'shippingAddress'));
    }
    
    public function store(Request $request, Item $item)
    {
        if ($item->isSold()) {
            return back();
        }

        $user = Auth::user();
        $address = $user->addresses()->first();

        if (!$address) {
            return back();
        }
        
        $paymentMethod = (int) $request->input('payment_method', 1);
        if (!in_array($paymentMethod, [1, 2], true)) {
        $paymentMethod = 1; 
        }

        Order::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_id'=> $address->id,
            'payment_method' => $paymentMethod,
        ]);

        return redirect()->route('items.index');
    }

}
