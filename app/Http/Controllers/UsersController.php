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

        $examination = Examination::whereRaw("FIND_IN_SET(?, school_rely)", [$user->school_id])->get();

        return view("user_center", compact(
            'user',
            'examination'
        ));
    }

}
