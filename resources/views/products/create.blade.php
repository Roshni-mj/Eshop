@extends('layouts.master')
@section('content')

    <h1>Create products</h1>
    <form method ="POST" action="{{ route('products.store')}} ">
        @csrf
    <div class ="form-row">
        <label for="">Title</label>
        <input type="text" class = "form-control" name="title">
    </div>
    <div class ="form-row">
        <label for="">Description</label>
        <input type="text" class = "form-control" name="description">
    </div>
    <div class ="form-row">
        <label for="">Price</label>
        <input type="number" class = "form-control" name="price">
    </div>
    <div class ="form-row">
        <label for="">Stock</label>
        <input type="number" class = "form-control" name="stock" min="0">
    </div>
    <div class ="form-row">
        <label for="">Status</label>
       <select name="status" id="" class="custom-select" required="">
        <option value="" selected>Select..</option>
        <option value="available" >Available</option>
        <option value="unavailable" >Unavailable</option>
       </select>
    </div>
    <div>
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>
    </form>
@endsection