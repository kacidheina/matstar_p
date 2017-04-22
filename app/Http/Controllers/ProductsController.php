<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::select('SELECT p.`id`, p.`id_category`, c.`name` as `category`, p.`code`, p.`color`, p.`numbering`, p.`price_bought`, p.`price_with_customs`, p.`price_wholesale`, p.`price_customer`, p.`quantity`, p.`description`, p.`note`, uc.`name` AS `creator`, um.`name` AS `modifier`, p.`created_at`, p.`updated_at` FROM `products` p LEFT JOIN `categories` c ON p.`id_category` = c.`id` LEFT JOIN `users` uc ON p.`user_create_id` = uc.`id` LEFT JOIN `users` um ON p.`user_modify_id` = uc.`id` WHERE p.`delete` = \'no\'');
        return view('products.products_listing',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('delete','no')->get();
        return view('products.add_product',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:2',
            'quantity' => 'required|numeric',
            'category' => 'required|numeric',
            'color' => 'required',
            'numbering_from' => 'required',
            'numbering_to' => 'required',
            'price_bought' => 'required',
            'price_customs' => 'required',
            'price_wholesale' => 'required',
            'price_customer' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');
        }

        $product = new Product();
        $product->code = $request->code;
        $product->id_category = $request->category;
        $product->quantity = $request->quantity;
        $product->color = $request->color;
        $product->numbering = $request->numbering_from.'-'.$request->numbering_to;
        $product->price_bought = $request->price_bought;
        $product->price_with_customs = $request->price_customs;
        $product->price_wholesale = $request->price_wholesale;
        $product->price_customer = $request->price_customer;
        $product->note = $request->note;
        $product->description = $request->description;
        $product->user_create_id = Auth::user()->id;
        $product->created_at = date("Y-m-d H:i:s");

        if ($product->save())
        {return redirect('products')->with('success','Artikulli u shtua me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('delete','no')->get();
        return view('products.edit_product',['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:2',
            'quantity' => 'required|numeric',
            'category' => 'required|numeric',
            'color' => 'required',
            'numbering_from' => 'required',
            'numbering_to' => 'required',
            'price_bought' => 'required',
            'price_customs' => 'required',
            'price_wholesale' => 'required',
            'price_customer' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');
        }


        $product->code = $request->code;
        $product->id_category = $request->category;
        $product->quantity = $request->quantity;
        $product->color = $request->color;
        $product->numbering = $request->numbering_from.'-'.$request->numbering_to;
        $product->price_bought = $request->price_bought;
        $product->price_with_customs = $request->price_customs;
        $product->price_wholesale = $request->price_wholesale;
        $product->price_customer = $request->price_customer;
        $product->note = $request->note;
        $product->description = $request->description;
        $product->user_modify_id = Auth::user()->id;
        $product->updated_at = date("Y-m-d H:i:s");

        if ($product->save())
        {return redirect('products')->with('success','Artikulli u ndryshua me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete = 'yes';
        $product->user_modify_id = Auth::user()->id;
        $product->updated_at = date("Y-m-d H:i:s");

        if ($product->save())
        {return redirect('products')->with('success','Artikulli u fshi me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }
}
