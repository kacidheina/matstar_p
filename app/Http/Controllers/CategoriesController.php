<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::select('SELECT c.`id`, c.`name`, c.`description`, uc.`name`AS `creator`, um.`name`AS `modifier`, c.`created_at`, c.`updated_at` FROM `categories` c LEFT JOIN `users` uc ON c.`user_create_id` = uc.`id` LEFT JOIN `users` um ON c.`user_modify_id` = um.`id` WHERE c.`delete` = \'no\'');
        return view('categories.categories_listing',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|min:4']);
        if ($validator->fails()) {return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');}

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->user_create_id = Auth::user()->id;
        $category->created_at = date("Y-m-d H:i:s");

        if ($category->save())
        {return redirect('categories')->with('success','Kategoria u shtua me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit_category',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|min:4']);
        if ($validator->fails()) {return redirect()->back()->with('error','Te dhenat nuk u futen ne formatin e duhur.');}

        $category->name = $request->name;
        $category->description = $request->description;
        $category->user_modify_id = Auth::user()->id;
        $category->updated_at = date("Y-m-d H:i:s");

        if ($category->save())
        {return redirect('categories')->with('success','Kategoria u nrysha me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete = 'yes';
        $category->user_modify_id = Auth::user()->id;
        $category->updated_at = date("Y-m-d H:i:s");

        if ($category->save())
        {return redirect('categories')->with('success','Kategoria u fshi me sukses.');}
        else
        {return redirect()->back()->with('error','Dicka shkoi gabim. Provoni perseri.');}
    }
}
