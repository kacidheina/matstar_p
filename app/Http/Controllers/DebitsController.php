<?php

namespace App\Http\Controllers;

use App\Story_Debts;
use App\Client;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class DebitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_company()
    {
        $company_debts = Story_Debts::with('creator')->with('modifier')->get();
        return view('debts.debit_list',['company_debts' => $company_debts]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_client()
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function create_client_Story_Debts(Client $client)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Client  $client
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_client_Story_Debts(Request $request, Client $client)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function show(Story_Debts $story_debts)
    {
        if ($story_debts->description != "")
        {return response()->json(['error' => false ,'type' => 'success' ,'description' => $story_debts->description]);}
        else
        {return response()->json(['error' => true ,'description' => 'Nuk ka asnje shenim per kete borxh']);}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function show_client_Story_Debts(Story_Debts $story_debts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function edit(Story_Debts $story_debts)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function edit_client_Story_Debts(Story_Debts $story_debts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story_Debts $story_debts)
    {
            $validator = Validator::make($request->all(),
            [
                'status' => 'required',
                'datepicker' => 'required',

            ]);
        if ($validator->fails()) {return response()->json(['error' => true ,'message' => 'Te dhenat nuk u futen ne formatin e duhur.']);}

        if($request->description == ""){ $text = $story_debts->description;}else{$text = $request->description;}
        $story_debts->status = $request->status;
        $story_debts->datePaymentClient = $request->datepicker;
        $story_debts->description = $text;
        $story_debts->user_modify_id = Auth::user()->id;
        $story_debts->updated_at = date("Y-m-d H:i:s");

        if ($story_debts->save())
        {return response()->json(['error' => false ,'type' => 'success' ,'message' => 'Borxhi u modifikua me sukses.' ,'data' => ['id' => $story_debts->id ,'status' => $story_debts->status,'description' => $story_debts->description,'datePaymentClient'=> $story_debts->datePaymentClient]]);}
        else
        {return response()->json(['error' => true ,'message' => 'Dicka shkoi gabim. Provoni perseri.']);}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function update_client_Story_Debts(Request $request, Story_Debts $story_debts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story_Debts $story_debts)
    {
        $story_debts->delete = 'yes';
        $story_debts->user_modify_id = Auth::user()->id;
        $story_debts->updated_at = date("Y-m-d H:i:s");

        if ($story_debts->save())
        {return response()->json(['error' => 'false', 'message' => 'Borxhi u fshi me sukses']);}
        else
        {return response()->json(['error' => 'true', 'message' => 'Dicka shkoi gabim.Provojeni perseri']);}
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story_Debts  $story_debts
     * @return \Illuminate\Http\Response
     */
    public function destroy_client_Story_Debts(Story_Debts $story_debts)
    {
        //
    }
}
