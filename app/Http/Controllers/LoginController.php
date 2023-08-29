<?php

namespace App\Http\Controllers;

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
            return redirect("/");
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
            return response()->json([
                'statusCode' => 401,
                'msg' => '验证码不正确！',
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'statusCode' => 200,
                'msg' => '验证成功！',
            ]);
        }

        return response()->json([
            'statusCode' => 400,
            'msg' => '姓名或学号不正确！请重新填写！',
        ]);
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
