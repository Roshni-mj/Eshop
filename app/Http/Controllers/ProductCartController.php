<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductCartController extends Controller
{
    public $cartService; //dependancy injection\

    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
    }



    public function store(Request $request, Product $product)
    {
        // $cart = Cart::create();
        $cart = $this->cartService->getFromCookieOrCreate();
        $quantity = $cart->products()->find($product->id)
                    ->pivot
                    ->quantity ?? 0 ;

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1],
        ]);
        $cookie = Cookie::make('cart',$cart->id, 7 * 24 * 60);
        return redirect()->back()->cookie($cookie);
    }


    public function destroy(Product $product, Cart $cart)
    {
        
    }

    public function getFromCookieOrCreate()
    {
        $cartId = Cookie::get('cart');
        $cart = Cart::find($cartId);
         return $cart ?? Cart::create();
    }
}
