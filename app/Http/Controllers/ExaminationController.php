<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{

    /*
     * 登录操作页面
     */
    public function index(Request $request, $exam_id)
    {
        if(!Auth::check()){
            return redirect("/");
        }
        $user = Auth::user();

        $examination = Examination::whereRaw("FIND_IN_SET(?, school_rely)", [$user->school_id])
            ->whereRaw("id = ?", [$exam_id])->first();
        if(empty($examination)){
            return back();
        }

        return view("exam_page", compact(
            'examination'
        ));
    }


    public function getQuestion(Request $request)
    {
        $user = Auth::user();
        $exam_id = $request->input('id');

        // 查询试卷该用户是否有权限
        $user = Auth::user();

        $examination = Examination::whereRaw("FIND_IN_SET(?, school_rely)", [$user->school_id])
            ->whereRaw("id = ?", [$exam_id])->first();
        if(empty($examination)){
            return response()->json(([
                'code' => 400,
                'msg' => '没有权限！',
            ]), 200);
        }

        $question = Question::whereIn('modular_id', $examination->modular_rely)->get()->toArray();

        return response()->json(([
            'code' => 200,
            'data' => $question,
            'msg' => '成功'
        ]), 200);

    }








}
