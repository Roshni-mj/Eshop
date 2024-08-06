@extends('layouts.master')
@section('content')

    <h1>Create products</h1>
    <form method ="POST" action="{{ route('products.update',['product' => $product->id])}} ">
        @csrf
        @method('PUT')

    <div class ="form-row">
        <label for="">Title</label>
        <input type="text" class = "form-control" name="title" value = "{{$product->title}}">
    </div>
    <div class ="form-row">
        <label for="">Description</label>
        <input type="text" class = "form-control" name="description" value = "{{$product->description}}">
    </div>
    <div class ="form-row">
        <label for="">Price</label>
        <input type="number" class = "form-control" name="price" value = "{{$product->price}}">
    </div>
    <div class ="form-row">
        <label for="">Stock</label>
        <input type="number" class = "form-control" name="stock" min="0" value = "{{$product->stock}}">
    </div>
    <div class ="form-row">
        <label for="">Status</label>
       <select name="status" id="" class="custom-select" required="">
       
        <option value="available" {{$product->status == 'available' ? 'selected' : " "}} >Available</option>
        <option value="unavailable" {{$product->status == 'unavailable' ? 'selected' : " "}}>Unavailable</option>
       </select>
    </div>
    <div>
        <button type="submit" class="btn btn-primary btn-lg">Update</button>
    </div>
    </form>
@endsection