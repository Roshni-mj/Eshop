<?php
namespace App\Services;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
class CartService
{
    protected $cookieName;
    protected $cookieExpiration;

    public function __construct()
    {
        $this->cookieName = config('cart.cookie.name');
        $this->cookieExpiration = config('cart.cookie.expiration');
    }

    public function getFromCookie()
    {
        $cartId = Cookie::get($this->cookieName);
        return  Cart::find($cartId);


    }

    public function getFromCookieOrCreate()
    {
        
        $cart = $this->getFromCookie();

        return $cart ?? Cart::create();
    }

    public function makeCookie(cart $cart)
    {
        return   Cookie::make($this->cookieName,$cart->id, $this->cookieExpiration);
    }

    public function countProducts()
    {
        $cart = $this->getFromCookie();

        if ($cart && $cart instanceof Cart) {
            // Ensure the relationship is correctly loaded
            $products = $cart->products; 

            // Check if $products is a collection and access pivot quantity
            if ($products) {
                return $products->pluck('pivot.quantity')->sum();
            }
        }
        // $cart = $this->getFromCookie();
        
        // if ($cart != null)
        // {
        //     return $cart->products->pluck('pivot.quantity')->sum();
        // }
         return 0;
    }
}