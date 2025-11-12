<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Relations\BelongsToMany;

class CategoryItem extends Model
{
    protected $table = 'category_item';
    
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
