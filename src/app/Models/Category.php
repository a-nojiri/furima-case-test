<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Item;

class Category extends Model
{
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'category_item')
                    ->withTimestamps();
    }
}
