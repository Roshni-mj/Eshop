<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelProduct extends Product
{
    use HasFactory;
    protected $table = "products";
    protected static function booted(): void
    {
         //
    }

}
