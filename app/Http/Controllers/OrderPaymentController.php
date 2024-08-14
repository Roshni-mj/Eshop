<?php

namespace App\Http\Controllers;
use App\Services\CartService;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPaymentController extends Controller
{
    
    public $cartService; //dependancy injection\

    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order)
    {
       return view ('payment.create')->with([
            'order' => $order,
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        return DB::transaction(function() use($order){
                    $this->cartService->getFromCookie()->products()->detach();
                $order->payment()->create([
                    'amount' => $order->total,
                    'payed_at' => now(),
                ]);
                $order->status = 'payed';
                $order->save();
                return redirect('/')->withSuccess("Thanks !, We received  your $ {$order->total} payment.");
            });

    }

    
}
