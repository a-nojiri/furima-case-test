<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Like;
use App\Models\Category;
use App\Models\Comment;




class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'condition' => 'integer',
    ];
    protected $appends = ['condition_label','image_url']; 

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function isSold(): bool
    {
        return $this->order()->exists();
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset($this->image_path) : null;
    }

    public function getConditionLabelAttribute(): string
    {
       $labels = config('item.condition_labels',[
           1 => '良好',
           2 => '目立った傷や汚れなし',
           3 => 'やや傷や汚れあり',
           4 => '状態が悪い',
       ]);
       
       return $labels[$this->condition] ?? '';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }

    public function likes()
    {
       return $this->hasMany(Like::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item')
                ->withTimestamps();
        
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


}
