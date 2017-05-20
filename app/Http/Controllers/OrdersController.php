<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Order;
use App\Order_Item;
use App\Product;
use App\Product_Variation;
use Illuminate\Http\Request;
use Auth;
class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_archive()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with(array('category' => function($query) {$query->select('id','name');}))->get();
        $clients = Client::where('delete','no')->get();

        return view('orders.create_order',['products'=>$products,'clients'=>$clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = json_decode($request->cart_details);
        $order = new Order();
        $order->id_client = $request->client;
        $order->user_create_id = Auth::user()->id;
        $order->created_at = date("Y-m-d H:i:s");
        $order->save();
        $total_difference = 0;
        $order_total = 0;
        foreach ($items as $key=>$item)
        {
            $id_details = explode("-",$item->id);
            $id_product = $id_details[0];
            $product_variation = Product_Variation::where('id_product',$id_product)->where('id_color',$item->color)->where('size',$item->size)->with('product')->first();
            $order_item = new Order_Item();
            $order_item->id_order = $order->id;
            $order_item->id_product_variation = $product_variation->id;
            $order_item->price_original = $product_variation->price_total;
            $order_item->price_sold = $item->price;
            $order_item->quantity = $item->quantity;
            $order_item->price_total = $item->quantity * $item->price;
            $order_item->difference = $item->price - $product_variation->price_total;
            $order_item->user_create_id = Auth::user()->id;
            $order_item->created_at = date("Y-m-d H:i:s");
            $order_item->save();
            $total_difference = $total_difference + $order_item->difference;
            $order_total = $order_total + $order_item->price_total;
        }

        if ($order_total > $request->client_paid){$order->status = 'in_debt';}
        $order->order_total = $order_total;
        $order->client_paid = $request->client_paid_final_form;
        $order->total_difference = $total_difference;
        $order->save();

        return redirect()->route('view_order_invoice',$order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }


    /**
     * Display the invoice of specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showInvoice(Order $order)
    {
        return  view('orders.invoice', ['rest'=>$order->client_paid-$order->order_total,'debt'=>$order->order_total-$order->client_paid,'order'=>$order->load('creator','modifier','orderItems','orderItems.variation','orderItems.variation.product','orderItems.variation.product.category','orderItems.variation.color')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
