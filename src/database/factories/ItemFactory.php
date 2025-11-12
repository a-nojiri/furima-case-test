<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        $candidates = [
            'images/items/watch.jpg',
            'images/items/hdd.jpg',
            'images/items/shoes.jpg',
            'images/items/laptop.jpg',
            'images/items/mic.jpg',
            'images/items/bag.jpg',
            'images/items/tumbler.jpg',
            'images/items/mill.jpg',
            'images/items/makeup.jpg',
            'images/items/onion.jpg',
        ];
        
        return [
            'user_id'    => 1,
            'name'       => $this->faker->words(3, true),
            'price'      => $this->faker->numberBetween(300, 50000),
            'brand' => $this->faker->randomElement(['なし','Rolax','Starbacks','西芝',]),
            'description'=> $this->faker->sentence(12),
            'condition'  => $this->faker->numberBetween(1,4),
            'image_path'  => $this->faker->randomElement($candidates),
        ];
    }
}
