@extends('layouts.app')
@section('content')
<h1>List of products</h1>
{{$subtitle}}
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
            <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->status}}</td>
            </tr>
           
           
        </tbody>

    </table>
  </div>
@endsection