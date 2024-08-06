<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        // $product = DB::table('products')->get();
        return 'This is the list of products from controller';
    }
    public function create()
    {
        return 'A form to create products from controller';
    }
    public function show($product)
    {
        return "Showing products of {$product} from controller ";
    }
    public function store($product)
    {
        
    }
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
