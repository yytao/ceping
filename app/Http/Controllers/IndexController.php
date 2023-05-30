<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    
    public function index()
    {
        if(Auth::check()) {
            return redirect("/user");
        }
        return view("index");
    }

    public function exam()
    {
        return view("exam_page");
    }

}
