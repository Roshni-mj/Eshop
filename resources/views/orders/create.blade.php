@extends('layouts.app')
@section('content')

    <h1>Order Details</h1>

    
    <h4 class="text-center"><strong>Grand Total</strong>   {{$cart->total}}</h4>
    <div class="text-center mb-3">
    <form class="d-inline" method="POST" action="{{ route('store') }}">
            @csrf
           
            <button class="btn btn-success" type="submit">Confim Order</button>
        </form>
    </div>
  
  <div class="table-responsive">
    <table class=" table table-striped">
        <thead class="thead-light">
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            
         

        </thead>
        <tbody>
            @foreach($cart->products as $pro)
            <tr>
                
                <td>
                    <img src="{{asset ($pro->images->first()->path) }}" width="100">
                    {{$pro->title}}
                </td>
                <td>{{$pro->price}}</td>
                <td>{{$pro->pivot->quantity}}</td>
                <td>{{$pro->total}}</td>
                
            </tr>
           @endforeach
        </tbody>

    </table>
  </div>
 
@endsection

