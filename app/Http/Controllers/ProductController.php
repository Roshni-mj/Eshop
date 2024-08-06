<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        //  $product = DB::table('products')->get();
        $product=Product::get(); // $product=Product::all(); 
         dd($product);
        // return 'This is the list of products from controller';
        return view ('products.index');
    }
    public function create()
    {
        return 'A form to create products from controller';
    }
    public function show($product)
    {
        // $product = DB::table('products')->where('id',$product)->get();
        // $product = DB::table('products')->where('id',$product)->first();
        // $product = DB::table('products')->find($product); //same as above query  
        $product = Product::findOrFail($product); // if the product is present, it shows the product details otherwise it shows not found
        dd($product);
        // return "Showing products of {$product} from controller ";
        // return view ("products.show");
    }
    // public function store($product)
    // {
        
    // }
    public function edit($product)
    {
        return "Showing the form to edit the products of {$product} from controller ";
    }
    public function update($product)
    {
        
    }
    public function destroy($product)
    {
        
    }

}
