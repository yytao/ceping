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

        //修改逻辑直接跳转到exam页
        $examination = Examination::where("school_id", $user->school_id)->first();
        if(!empty($examination) && $examination->id) {

            return redirect("/exam/$examination->id");

        } else {
            echo "错误，未指定试卷";
            die;
        }


        //由于更改了school_rely为school_id，所以不用此语句检索了
//        $examination = Examination::whereRaw("FIND_IN_SET(?, school_rely)", [$user->school_id])->get();

        $examination = Examination::where("school_id", $user->school_id)->get();

        return view("user_center", compact(
            'user',
            'examination'
        ));
    }


    /*
     * 用户修改信息页面
     */
    public function editInfo(Request $request)
    {

        return view('editInfo');
    }

    public function editInfoDo(Request $request)
    {




    }

    /*
     * 用户修改密码页面
     */
    public function editPassWord(Request $request)
    {

        return view('editPassWord');
    }

    public function editPassWordDo(Request $request)
    {


    }



}
