<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Product;
use App\ProductEntryHistory;
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
        $products = Product::with('category')->with('creator')->with('modifier')->with('entries')->get();
        return view('products.products_listing', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $colors = Color::orderBy('code', 'DESC')->get();
        return view('products.add_product', ['categories' => $categories, 'colors' => $colors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'code' => 'required|min:2',
            'category' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Te dhenat nuk u futen ne formatin e duhur.');
        }

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->id_category = $request->category;
        $product->description = $request->description;
        $product->user_create_id = Auth::user()->id;
        $product->created_at = date("Y-m-d H:i:s");

        if ($product->save())
        { return redirect()->route('view_product',$product->id);
            //return view('products.view_product', ['product' => $product])->with('success', 'Artikulli u shtua me sukses.');
            }
        else
        {return redirect()->back()->with('error', 'Dicka shkoi gabim. Provoni perseri.');}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $colors = Color::get();
        $value = ($colors->where('id',1))->toArray()[0]['name'];


        $variations_collection= collect($product->variations_simplified);
        $grouped_variations = $variations_collection->groupBy('size')->transform(function($item, $k) {
            return $item->groupBy('id_color')->transform(function($item, $k) {
                $obj = ['stock' => $item->sum('stock'),'total_price'=>$item->avg('price_total')];
                return $obj;
            });
        });

        return json_encode($grouped_variations->toArray());

        $colors = Color::get();

        return  view('products.view_product', ['colors'=>$colors,'product' => $product->load('category', 'variations.color','variations.entry','variations.creator','variations.modifier', 'entries.creator','entries.modifier', 'modifier', 'creator')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function get_product_variations(Product $product)
    {
        $variations_collection= collect($product->variations);
        $grouped_variations = $variations_collection->groupBy('color')->groupBy('size');

        return $grouped_variations->toArray();
        //return  view('products.view_product', ['colors'=>$colors,'product' => $product->load('category', 'variations.color','variations.entry','variations.creator','variations.modifier', 'entries.creator','entries.modifier', 'modifier', 'creator')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('delete', 'no')->get();
        return view('products.edit_product', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'code' => 'required|min:2',
            'category' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Te dhenat nuk u futen ne formatin e duhur.');
        }

        $product->name = $request->code;
        $product->code = $request->code;
        $product->id_category = $request->category;
        $product->description = $request->description;
        $product->user_modify_id = Auth::user()->id;
        $product->updated_at = date("Y-m-d H:i:s");

        if ($product->save())
        {return  view('products.view_product', ['product' => $product])->with('success', 'Artikulli u ndryshua me sukses.');}
        else
        {return redirect()->back()->with('error', 'Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete = 'yes';
        $product->user_modify_id = Auth::user()->id;
        $product->updated_at = date("Y-m-d H:i:s");

        if ($product->save()) {
            return response()->json(['error' => 'false', 'message' => 'Artikulli u fshi me sukses']);
        } else {
            return response()->json(['error' => 'true', 'message' => 'Dicka shkoi gabim.Provojeni perseri']);
        }
    }
}
