<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =DB::select('SELECT c.*, uc.`name` AS `creator`, um.`name` AS `modifier`, c.`created_at`, c.`updated_at` FROM `users` c LEFT JOIN `users` uc ON c.`user_create_id`= uc.`id` LEFT JOIN `users` um ON c.`user_modify_id`= um.`id` WHERE c.`delete` = \'no\'');
         return view('users.users_listing',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add_user');
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
                'email' => 'required',
                'status' => 'required',
                'password' => 'required|min:8'
            ]);
        if ($validator->fails()) {return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');}

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password = bcrypt($request->password);
        $user->user_create_id = Auth::user()->id;
        $user->created_at = date("Y-m-d H:i:s");

        if ($user->save())
        {return redirect('users')->with('success','Perdoruesi u shtua me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user){
            $user->delete = 'yes';
            $user->user_modify_id = Auth::user()->id;
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
            return response()->json(['message' => 'Perdorues u fshi me sukses','error' => 'false']);
        }
    }
}
