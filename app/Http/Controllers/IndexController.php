<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function index()
    {
        return view("index");
    }
    public function login()
    {
        return view("login");
    }
    public function user()
    {
        return view("user_center");
    }
    public function exam()
    {
        return view("exam_page");
    }













    public function layoutData()
    {

    }
}
