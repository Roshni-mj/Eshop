@extends('layouts.master')
@section('content')

    <h1>List of products</h1>
    {{-- @if(empty($product)) --}} 
  
    @empty ($products)
    <div class ="alert alert-warning">
       The list of product is empty
    </div>
    @else
    
  <div class="table-responsive">
    <table class=" table table-striped">
        <thead class="thead-light">
            <th>Id</th>
            <th>Item</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
         

        </thead>
        <tbody>
            @foreach($products as $pro)
            <tr>
                <td>{{$pro->id}}</td>
                <td>{{$pro->title}}</td>
                <td>{{$pro->description}}</td>
                <td>{{$pro->price}}</td>
                <td>{{$pro->stock}}</td>
                <td>{{$pro->status}}</td>
            </tr>
           @endforeach
        </tbody>

    </table>
  </div>
  @endif
@endsection

