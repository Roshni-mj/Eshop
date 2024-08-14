<?php

namespace App\Models;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Image;
use App\Models\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ="products";
    protected $with = [
        'images',
    ];


    protected $fillable = [
        'title',
        'description' ,
        'price',
        'stock',
        'status',
    ];

    protected static function booted(): void
    {
         static::addGlobalScope(new AvailableScope);
    }



    public function carts()
    {
        return $this->morphedByMany(Cart::class,'productable')->withPivot('quantity');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }


    // =====================================================================

    public function scopeAvailable($query)
    {
        return $query->where('status','available');
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->pivot->quantity;
    }
}
