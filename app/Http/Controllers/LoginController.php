<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    /*
     * 登录操作页面
     */
    public function loginView()
    {
        if(Auth::check()){
            return redirect("/user");
        }
        return view("login");
    }

    /*
     * 登录动作，验证用户名及密码
     * params：用户名name，密码password，验证码captcha
     */
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if(!captcha_check($request->input("captcha"))) {

            return redirect('login//')->withErrors(['error'=>'验证码不正确！']);

        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            $examination = Examination::where("school_id", $user->school_id)->first();
            if(empty($examination)) {
                Auth::logout();
                Session::flush();
                return redirect('login//')->withErrors(['error'=>'错误，未指定试卷！']);
            }

            $isTest = ExaminationResults::where('examination_id', $examination->id)
                ->where('user_id', $user->id)
                ->first();

            if(!empty($isTest) && $isTest->id) {
                Auth::logout();
                Session::flush();

                return redirect('login//')->withErrors(['error'=>'您已经做过测试了！请勿重复答题！']);
                return response()->json([
                    'statusCode' => 400,
                    'msg' => '',
                ]);
            }

            return redirect('user//');
        }

        return redirect('login//')->withErrors(['error'=>'姓名或学号不正确！请重新填写！']);

    }

    /*
     * 退出登录方法
     */
    public function logOut()
    {
        Auth::logout();
        Session::flush();
        return redirect()->intended('/');
    }

}
