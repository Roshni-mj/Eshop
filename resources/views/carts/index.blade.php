@extends('layouts.app')
@section('content')
<h1>Your Cart</h1>
@if ($cart->products->isEmpty())
    <div class ="alert alert-warning">
       Your cart  is empty
    </div>
    @else
    
    <h4 class="text-center"><strong>Grand Total</strong>   {{$cart->total}}</h4>
    <a class="btn btn-success mb-3" href="{{ route('orders.create')}}"> Start Order</a>
    <div class="row">
        @foreach($cart->products as $product)
        <div class ="col-3">
            @include('components.product-card')
      
        </div>

        @endforeach
        </div>
    @endif
@endsection