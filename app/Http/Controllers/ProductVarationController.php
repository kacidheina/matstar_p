<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use App\Product_Variation;
use App\ProductEntryHistory;
use App\SystemVariable;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class ProductVarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        $validator = Validator::make($request->all(), [
            'color' => 'required',
            'size' => 'required',
            'quantity' => 'required',
            'price_bought' => 'required',
            'price_customs' => 'required',
            'price_total' => 'required'
        ]);
        $entry = ProductEntryHistory::find($request->entry);
        $color = Color::find($request->color);
        if ($validator->fails()) {return response()->json(['error'=> true, 'message'=>'Te dhenat nuk u futen ne formatin e duhur.']);}
        if (!$entry) {return response()->json(['error'=> true, 'message'=>'Hyrja qe ju zgjodhet nuk ekziston.']);}
        if (!$color) {return response()->json(['error'=> true, 'message'=>'Ngjyra qe ju zgjodhet nuk ekziston.']);}

        $variation = new Product_Variation();
        $variation->id_product = $product->id;
        $variation->id_entry = $request->entry;
        $variation->id_color = $request->color;
        $variation->size = $request->size;
        $variation->quantity = $request->quantity;
        $variation->stock = $request->quantity;
        $variation->price_bought = $request->price_bought;
        $variation->price_customs = $request->price_customs;
        $variation->price_total = $request->price_total;
        $variation->note = $request->note;
        $variation->user_create_id = Auth::user()->id;
        $variation->created_at = date("Y-m-d H:i:s");
        if ($variation->save())
        {
            $actionBar = '<div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button><ul class="dropdown-menu"><li><a href=""><i class="fa fa-eye"></i>Shiko Profil</a></li><li><a href=""><i class="fa fa-edit"></i>Ndrysho</a></li><li><a class="delete_client"><i class="fa fa-trash"></i>Fshij</a></li></ul></div>';
            $row = [$variation->id,'<p hidden="">'.$entry->entry_date.'</p>'.Date::parse($variation->entry_date)->format('j M Y'),'<div style="border: 15px solid '.$color->code.';padding: 3px;width: 100%;"><p style="text-align: center;margin: 0;">'.$color->name.'</p></div>','<h2><strong>'.$variation->size.'</strong></h2>','Mbetur : <strong style="float: right;">'.$variation->quantity.'</strong><br>Hyre : <strong style="float: right;">'.$variation->quantity.'</strong>', $variation->price_total,'Nga:<b>'.Auth::user()->name.'</b><br>Me:<b>'.Date::parse($variation->created_at)->format('j M Y'),$actionBar];
            return response()->json(['error'=> false, 'message'=>'Variacioni u shtua me sukses','row'=>$row,'id'=>$variation->id]);
        }
        else
        {  return response()->json(['error'=> true, 'message'=>'Dicka shkoi gabim. Provoni perseri.']);}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_Variation  $product_Variation
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Variation $product_Variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_Variation  $product_Variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_Variation $product_Variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_Variation  $product_Variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_Variation $product_Variation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_Variation  $product_Variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_Variation $product_Variation)
    {
        //
    }
}
