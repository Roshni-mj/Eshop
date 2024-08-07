<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth')->except(['index','show']);
    }
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

        $rules = [
            'title' =>['required', 'max:255'],
            'description' =>['required','max:1000'],
            'price' =>['required','min:1'],
            'stock' =>['required','min:0'],
            'status' =>['required','in:available,unavailable'],
        ];
        request()->validate($rules);
        if (request()->stock == 0 && request()->status == 'available')
        {
            // session()->flash('error','If available must have stock');
            return redirect()->back()->withInput(request()->all())->withErrors('If available must have stock');
        }
        $product = Product::create(request()->all());
        // session()->flash('success',"new product is created");

        
        // session()->forget('error');
        return redirect()->route('products.index')->withSuccess("new product is created");
        // ->with(['success' => "new product is created"]);
        // return $product;
        
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
        $rules = [
            'title' =>['required', 'max:255'],
            'description' =>['required','max:1000'],
            'price' =>['required','min:1'],
            'stock' =>['required','min:0'],
            'status' =>['required','in:available,unavailable'],
        ];
        request()->validate($rules);
        $product = Product::findOrFail($product);
        $product->update(request()->all());
        
        // return $product;
        // return redirect()->back(); //redirect to previouse location
         return redirect()->route('products.index')->withSuccess(" product updated successfully");
        
    }
    

    // ----------------------------------------delete product----------------------
    public function destroy($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index')->withSuccess(" product deleted successfully");
        
        // return $product;

    }

}
