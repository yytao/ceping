<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    /*
     * 登录操作页面
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect("/");
        }

        $user = Auth::user();
        //由于更改了school_rely为school_id，所以不用此语句检索了
//        $examination = Examination::whereRaw("FIND_IN_SET(?, school_rely)", [$user->school_id])->get();

        $examination = Examination::where("school_id", $user->school_id)->get();

        return view("user_center", compact(
            'user',
            'examination'
        ));
    }

}
