<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PanelProduct;
use App\Http\Requests\ProductRequest;
use App\Models\Scopes\AvailableScope;
use Illuminate\Support\Facades\File;

 use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
 

   
    // -------------------------------------view product---------------------------
    public function index()
    {
        //  $product = DB::table('products')->get();
        $products=PanelProduct::without('images')->get(); // $product=Product::all(); 
        return view ('products.index')->with(['products'=> $products]);
    }
    // ------------------------create product-------------------------------------

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest  $request)
    {
        // dd($request->validated());
        
        // $rules = [
        //     'title' =>['required', 'max:255'],
        //     'description' =>['required','max:1000'],
        //     'price' =>['required','min:1'],
        //     'stock' =>['required','min:0'],
        //     'status' =>['required','in:available,unavailable'],
        // ];
        // request()->validate($rules);
        // if (request()->stock == 0 && request()->status == 'available')
        // {
        //     // session()->flash('error','If available must have stock');
        //     return redirect()->back()->withInput(request()->all())->withErrors('If available must have stock');
        // }
        $product = PanelProduct::create(request()->all());
        foreach ($request->images as $image)
        {
            $product->images()->create([
                'path' => 'images/'. $image->store('products','images'),
            ]);
        }
        // session()->flash('success',"new product is created");

        
        // session()->forget('error');
        return redirect()->route('products.index')->withSuccess("new product is created");
        // ->with(['success' => "new product is created"]);
        // return $product;
        
    }
    // ---------------------------------show product-------------------------------------------

    public function show(PanelProduct $product)
    {
        // $product = DB::table('products')->where('id',$product)->get();
        // $product = DB::table('products')->where('id',$product)->first();
        // $product = DB::table('products')->find($product); //same as above query  
        // $product = Product::findOrFail($product); // if the product is present, it shows the product details otherwise it shows not found
       
         return view ("products.show")->with(['product'=> $product, 'subtitle' =>'something',]);
    }

    // -------------------------------------------------edit product----------------------------
    public function edit(PanelProduct $product)
    {
        // return "Showing the form to edit the products of {$product} from controller ";
        // $product = Product::findOrFail($product); // if the product is present, it shows the product details otherwise it shows not found
       
         return view ("products.edit")->with(['product'=> $product,]);
    }
    
    public function update(ProductRequest  $request,PanelProduct $product)
    {
        $product->update($request->validated());
        if($request->hasFile('images'))
        {
            foreach ($product->images as $image) 
            {
                $path = storage_path("app/public/{$image->path}");
                File::delete($path);
                $image->delete();
            }
            foreach ($request->images as $image)
            {
                $product->images()->create([
                    'path' => 'images/'. $image->store('products','images'),
                ]);
            }
        }
        // $rules = [
        //     'title' =>['required', 'max:255'],
        //     'description' =>['required','max:1000'],
        //     'price' =>['required','min:1'],
        //     'stock' =>['required','min:0'],
        //     'status' =>['required','in:available,unavailable'],
        // ];
        // request()->validate($rules);
        // $product = Product::findOrFail($product);
        // $product->update(request()->all());
        
        // return $product;
        // return redirect()->back(); //redirect to previouse location
         return redirect()->route('products.index')->withSuccess(" product updated successfully");
        
    }
    

    // ----------------------------------------delete product----------------------
    public function destroy(PanelProduct $product)
    {
        // $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index')->withSuccess(" product deleted successfully");
        
        // return $product;

    }

}
