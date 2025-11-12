<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class ItemSeeder extends Seeder
{
    private string $sellerEmail = 'seller@example.com';
    private string $buyerEmail  = 'buyer@example.com';

    public function run(): void
    {
        $seller = User::firstOrCreate(
            ['email' => $this->sellerEmail],
            ['name' => 'Seller', 'password' => Hash::make('password')]
        );

        $buyer = User::firstOrCreate(
            ['email' => $this->buyerEmail],
            ['name' => 'Buyer', 'password' => Hash::make('password')]
        );

        $rows = [
            ['name'=>'腕時計','price'=>15000,'brand'=>'Rolax','description'=>'スタイリッシュなメンズ腕時計','file'=>'watch.jpg'],
            ['name'=>'HDD','price'=>5000,'brand'=>'西芝','description'=>'高速で信頼性の高いハードディスク','file'=>'hdd.jpg'],
            ['name'=>'玉ねぎ3束','price'=>300,'brand'=>'なし','description'=>'新鮮な玉ねぎ3束セット','file'=>'onion.jpg'],
            ['name'=>'革靴','price'=>4000,'brand'=>'なし','description'=>'クラシックなデザインの革靴','file'=>'shoes.jpg'],
            ['name'=>'ノートPC','price'=>45000,'brand'=>'なし','description'=>'高性能なノートパソコン','file'=>'laptop.jpg'],
            ['name'=>'マイク','price'=>8000,'brand'=>'なし','description'=>'高音質のレコーディング用マイク','file'=>'mic.jpg'],
            ['name'=>'ショルダーバッグ','price'=>3500,'brand'=>'なし','description'=>'おしゃれなショルダーバッグ','file'=>'bag.jpg'],
            ['name'=>'タンブラー','price'=>500,'brand'=>'なし','description'=>'使いやすいタンブラー','file'=>'tumbler.jpg'],
            ['name'=>'コーヒーミル','price'=>4000,'brand'=>'Starbacks','description'=>'手動のコーヒーミル','file'=>'mill.jpg'],
            ['name'=>'メイクセット','price'=>2500,'brand'=>'なし','description'=>'便利なメイクアップセット','file'=>'makeup.jpg'],
        ];

       $items = [];
        foreach ($rows as $r) {
            $items[] = Item::create([
                'user_id'     => $seller->id,
                'name'        => $r['name'],
                'price'       => $r['price'],
                'brand'       => $r['brand'] === 'なし' ? null : $r['brand'],
                'description' => $r['description'],
                'condition'   => 1,
                'image_path'  => 'images/items/'.$r['file'],
            ]);
        }

        if ($buyer) {
            $address = Address::firstOrCreate(
                ['user_id' => $buyer->id],
                [
                    'postal_code' => '1000001',
                    'prefecture'  => '東京都',
                    'city'        => '杉並区',
                    'block'     => '和田1-1',
                    'building'    => null,
                    'phone'       => '0123456789',
                ]
            );

            // 最初の3件を「購入済み」にする
            foreach (array_slice($items, 0, 3) as $it) {
                Order::create([
                    'item_id'        => $it->id,      
                    'user_id'        => $buyer->id,
                    'address_id'     => $address->id, 
                    'payment_method' => 1,            
                ]);
            }
        }
    }
}