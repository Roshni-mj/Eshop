<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    // -------------------------------------view product---------------------------
    public function index()
    {
        //  $product = DB::table('products')->get();
        $products=Product::get(); // $product=Product::all(); 
        return view ('products.index')->with(['products'=> $products]);
    }
    // ------------------------create product-------------------------------------

    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        // $product = Product::create([
        //     'title'=> request()->title,
        //     'description' => request()->description,
        //     'price' => request()->price,
        //     'status'=> request()->status,
        //     'stock' => request()->stock,
        // ]);
        $product = Product::create(request()->all());
        return $product;
        
    }
    // ---------------------------------show product-------------------------------------------

    public function show($product)
    {
        // $product = DB::table('products')->where('id',$product)->get();
        // $product = DB::table('products')->where('id',$product)->first();
        // $product = DB::table('products')->find($product); //same as above query  
        $product = Product::findOrFail($product); // if the product is present, it shows the product details otherwise it shows not found
       
         return view ("products.show")->with(['product'=> $product, 'subtitle' =>'something',]);
    }

    // -------------------------------------------------edit product----------------------------
    public function edit($product)
    {
        // return "Showing the form to edit the products of {$product} from controller ";
        $product = Product::findOrFail($product); // if the product is present, it shows the product details otherwise it shows not found
       
         return view ("products.edit")->with(['product'=> $product,]);
    }
    
    public function update($product)
    {
        $product = Product::findOrFail($product);
        $product->update(request()->all());
        
        return $product;

    }

    // ----------------------------------------delete product----------------------
    public function destroy($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return $product;

    }

}
