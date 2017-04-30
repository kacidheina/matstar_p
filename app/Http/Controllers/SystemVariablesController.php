<?php

namespace App\Http\Controllers;

use App\SystemVariable;
use Illuminate\Http\Request;

class SystemVariablesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param SystemVariable $systemVariable
     */
    public function update_course(Request $request)
    {
        $course= SystemVariable::get()->first();
        $course->curse_lev = $request->course_lev;
        $course->curse_lek = $request->course_lek;
        $course->save();

        return response()->json(['error'=>'false','course_lev'=>$course->curse_lev,'course_lek'=>$course->curse_lek]);
    }

}
