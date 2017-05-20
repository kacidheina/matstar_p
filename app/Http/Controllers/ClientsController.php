<?php

namespace App\Http\Controllers;

use App\Client;
use App\Debit;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::select('SELECT c.`id`, c.`name`, c.`phone`,c.`debt`,c.`nipt`, c.`city`, c.`delete`, uc.`name` AS `creator`, um.`name` AS `modifier`, c.`created_at`, c.`updated_at` FROM `clients` c LEFT JOIN `users` uc ON c.`user_create_id`= uc.`id` LEFT JOIN `users` um ON c.`user_modify_id`= um.`id` WHERE c.`delete` = \'no\'');

        return view('clients.clients_listing',['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.add_client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:4',
                'phone' => 'numeric',
                'city' => 'required',
                'nipt' => 'required|min:3'
            ]);
        if ($validator->fails()) {return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');}

        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->city = $request->city;
        $client->nipt = $request->nipt;
        $client->user_create_id = Auth::user()->id;
        $client->created_at = date("Y-m-d H:i:s");

        if($request->ajax()){
            if ($client->save())
            {return response()->json(['error' => false ,'type' => 'success' ,'message' => 'Klienti u shtua me sukses.' ,'data' => ['id' => $client->id ,'name' => $client->name]]);}
            else
            {return response()->json(['error' => true ,'message' => 'Dicka shkoi gabim. Provoni perseri.']);}
        }

        if ($client->save())
        {return redirect('clients')->with('success','Klienti u shtua me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.profil_client',['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit_client',['client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:4',
                'phone' => 'numeric',
                'city' => 'required',
                'nipt' => 'required|min:3'
            ]);
        if ($validator->fails()) {return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');}

        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->city = $request->city;
        $client->nipt = $request->nipt;
        $client->user_modify_id = Auth::user()->id;
        $client->updated_at = date("Y-m-d H:i:s");

        if ($client->save())
        {return redirect('clients')->with('success','Klienti u ndryshua me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete = 'yes';
        $client->user_modify_id = Auth::user()->id;
        $client->updated_at = date("Y-m-d H:i:s");

        if ($client->save())
        {return response()->json(['error' => 'false', 'message' => 'Klienti u fshi me sukses']);}
        else
        {return response()->json(['error' => 'true', 'message' => 'Dicka shkoi gabim.Provojeni perseri']);}
    }
}
