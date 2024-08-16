@extends('layouts.app')
@section('content')

    <h1>Create products</h1>
    <form method ="POST" action="{{ route('products.update',['product' => $product->id])}} " enctype="multipart/form-data">
        @csrf
        @method('PUT')

    <div class ="form-row">
        <label for="">Title</label>
        <input type="text" class = "form-control" name="title" value = "{{old('title') ?? $product->title}}">
    </div>
    <div class ="form-row">
        <label for="">Description</label>
        <input type="text" class = "form-control" name="description" value = "{{ old('description') ?? $product->description}}">
    </div>
    <div class ="form-row">
        <label for="">Price</label>
        <input type="number" class = "form-control" name="price" value = "{{ old('price') ?? $product->price}}">
    </div>
    <div class ="form-row">
        <label for="">Stock</label>
        <input type="number" class = "form-control" name="stock" min="0" value = "{{old('stock') ?? $product->stock}}">
    </div>
    <div class ="form-row">
        <label for="">Status</label>
       <select name="status" id="" class="custom-select" required="">
       
       <option value="available" {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }}>Available</option>
       <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }}>Unavailable</option>

      
       </select>
    </div>
    <div class="form-row">
        <label for="" >{{ __('Images') }}</label>

       
            <div class="custom-file">
            <input  type="file" class="custom-file-input" name="images[]" accept="images/*" multiple>
            <!-- <label class="custom-file-label"> Profile image...</label> -->
            </div>
       
    </div>
    <div>
        <button type="submit" class="btn btn-primary btn-lg mt-3">Update</button>
    </div>
    </form>
@endsection