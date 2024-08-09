<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public $cartService; //dependancy injection\

    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        $cart = $this->cartService->getFromCookieOrCreate();
       return view ('carts.index')->with([
        'cart' => $cart,
       ]);
    }

   
}
