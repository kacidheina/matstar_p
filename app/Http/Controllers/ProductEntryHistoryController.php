<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductEntryHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Jenssegers\Date\Date;

class ProductEntryHistoryController extends Controller
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
        return view('products.product_entries.add_entry',['product'=>$product]);
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
        $validator = Validator::make($request->all(), ['date' => 'required',]);
        if ($validator->fails()) {return response()->json(['error'=> true, 'message'=>'Te dhenat nuk u futen ne formatin e duhur.']);}

        $entry = new ProductEntryHistory();
        $entry->id_product = $product->id;
        $entry->entry_date = date('Y-m-d H:i:s', strtotime($request->date));
        $entry->user_create_id = Auth::user()->id;
        $entry->created_at = date("Y-m-d H:i:s");

        if ($entry->save())
        {
            $actionBar = '<div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Veprime<span class="caret"></span></button><ul class="dropdown-menu"><li><a href=""><i class="fa fa-eye"></i>Shiko Profil</a></li><li><a href=""><i class="fa fa-edit"></i>Ndrysho</a></li><li><a class="delete_client"><i class="fa fa-trash"></i>Fshij</a></li></ul></div>';
            $row = [$entry->id,'<p hidden="">'.$entry->entry_date.'</p>'.Date::parse($entry->entry_date)->format('j M Y'),Auth::user()->name,' E pandryshuar.',' E pandryshuar.',$actionBar];
            return response()->json(['error'=> false, 'message'=>'Hyrja u shtua me sukses','row'=>$row,'id'=>$entry->id]);
        }
        else
        {  return response()->json(['error'=> true, 'message'=>'Dicka shkoi gabim. Provoni perseri.']);}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductEntryHistory  $productEntryHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductEntryHistory $productEntryHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductEntryHistory  $productEntryHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductEntryHistory $productEntryHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductEntryHistory  $productEntryHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductEntryHistory $productEntryHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductEntryHistory  $productEntryHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductEntryHistory $productEntryHistory)
    {
        //
    }
}
