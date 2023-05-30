<?php

namespace App\Http\Controllers;

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

        return view("user_center", compact(
            'user'
        ));
    }

}
