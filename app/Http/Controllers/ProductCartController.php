<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;

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

        if($product->stock < $quantity + 1)
        {
            throw ValidationException::withMessages([
                'cart' => "There is not enough stock for the quantity you required of {$product->title}",
            ]);
        }

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1],
        ]);
        $cookie = $this->cartService->makeCookie($cart); 

        return redirect()->back()->cookie($cookie);
    }


    public function destroy(Product $product, Cart $cart)
    {
       $cart->products()->detach($product->id);

       $cookie = $this->cartService->makeCookie($cart);

       return redirect()->back()->cookie($cookie);
    }

    public function getFromCookieOrCreate()
    {
        $cartId = Cookie::get('cart');
        $cart = Cart::find($cartId);
         return $cart ?? Cart::create();
    }
}
