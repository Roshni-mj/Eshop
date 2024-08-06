@extends('layouts.master')
@section('content')

    <h1>List of products</h1>

    <a class="btn btn-success" href="{{route('products.create')}}">Create</a>

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
            <th>Action</th>
         

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
                <td>
                  <a class="btn btn-link" href="{{route('products.show',['product'=> $pro->id])}}">Show</a>
                  <a class="btn btn-link" href="{{route('products.edit',['product'=> $pro->id])}}">Edit</a>
                  <form method="POST" action="{{route('products.delete',['product'=> $pro->id])}}">
                    @csrf
                    @method('DELETE')
                    <button class =" btn btn-link" type="submit">Delete</button>
                  </form>
                </td>
            </tr>
           @endforeach
        </tbody>

    </table>
  </div>
  @endif
@endsection

