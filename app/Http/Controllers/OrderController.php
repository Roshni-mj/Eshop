<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public $cartService; //dependancy injection\

    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }
   
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        if(!isset($cart) || $cart->products->isEmpty())
        {
            return redirect()->back()
            ->withErrors('Your cart is empty');
        }
        return view('orders.create')->with([
            'cart' => $cart,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $order = $user->orders()->create([
            'status' => 'Pending',  
            ]);

        $cart = $this->cartService->getFromCookie();
        $cartsProductsWithQuantity = $cart
                            ->products
                            ->mapWithKeys(function ($product){
                                $element[$product->id] = ['quantity'=> $product->pivot->quantity];
                                return $element;

                            });
                            $order->products()->attach($cartsProductsWithQuantity->toArray());
        
                            return redirect()->route('orders.payments.create',['order'=>$order->id]);

       
    }

    
}
