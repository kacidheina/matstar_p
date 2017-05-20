<?php

namespace App\Http\Controllers;

use App\Expenses;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses= Expenses::with('creator')->with('modifier')->get();
        return view('expenses.expenses_listing',['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.add_expense');
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
            'sum' => 'required',
            'subject' => 'required',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Te dhenat nuk u futen ne formatin e duhur.');
        }

        $expence = new Expenses();
        $expence->sum = $request->sum;
        $expence->subject = $request->subject;
        $expence->date = $request->date;
        $expence->note = $request->note;
        $expence->user_create_id = Auth::user()->id;
        $expence->created_at = date("Y-m-d H:i:s");
        $expence->updated_at = "0000-00-00 00:00:00";

        if ($expence->save())
        { return redirect()->route('expenses_list')->with('success', 'Shpenzimi u shtua me sukses.');

        }
        else
        {return redirect()->back()->with('error', 'Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        if ($expenses->note != "")
        {return response()->json(['error' => false ,'type' => 'success' ,'description' => $expenses->note]);}
        else
        {return response()->json(['error' => true ,'description' => 'Nuk ka asnje shenim per kete shpenzim']);}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenses $expenses)
    {
        $validator = Validator::make($request->all(),
            [
                'status' => 'required',
                'date' => 'required',

            ]);
        if ($validator->fails()) {return response()->json(['error' => true ,'message' => 'Te dhenat nuk u futen ne formatin e duhur.']);}

        $expenses->status = $request->status;
        $expenses->date = $request->date;
        $expenses->note = $request->description;
        $expenses->user_modify_id = Auth::user()->id;
        $expenses->updated_at = date("Y-m-d H:i:s");

        if ($expenses->save())
        {return response()->json(['error' => false ,'type' => 'success' ,'message' => 'Shpenzimi u modifikua me sukses.' ,'data' => ['id' => $expenses->id ,'status' => $expenses->status,'description' => $expenses->note,'date'=> $expenses->date]]);}
        else
        {return response()->json(['error' => true ,'type' => 'error' ,'message' => 'Dicka shkoi gabim. Provoni perseri.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        $expenses->delete = 'yes';
        $expenses->user_modify_id = Auth::user()->id;
        $expenses->updated_at = date("Y-m-d H:i:s");

        if ($expenses->save())
        {return response()->json(['error' => 'false', 'message' => 'Shpenzimi u fshi me sukses']);}
        else
        {return response()->json(['error' => 'true', 'message' => 'Dicka shkoi gabim.Provojeni perseri']);}
    }
}
