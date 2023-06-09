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

        //$examination = Examination::whereRaw("FIND_IN_SET(?, school_rely)", [$user->school_id])
        $examination = Examination::where("school_id", $user->school_id)
            ->where("id", $exam_id)->first();
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

        $examination = Examination::where("school_id", $user->school_id)
            ->where("id", $exam_id)->first();
        if(empty($examination)){
            return response()->json(([
                'code' => 400,
                'msg' => '没有权限！',
            ]), 200);
        }

        $isTest = ExaminationResults::where('examination_id', $exam_id)
            ->where('user_id', $user->id)
            ->first();
        if($isTest) {
            return response()->json(([
                'code' => 400,
                'msg' => '您已经做过该试卷！',
            ]), 200);
        }

        $question = Question::whereIn('modular_id', $examination->modular_rely)->get()->toArray();

        return response()->json(([
            'code' => 200,
            'data' => $question,
            'msg' => '成功'
        ]), 200);

    }

    public function resultSubmit(Request $request)
    {
        $data = [];
        $data['examination_id'] = $request->input('id');
        $data['user_id'] = Auth::user()->id;
        $data['school_id'] = Auth::user()->school_id;
        $data['result'] = json_encode($request->input('result'));

        try {

            ExaminationResults::create($data);

            return response()->json(([
                'code' => 200,
                'msg' => '您已提交完成'
            ]), 200);

        } catch (\Exception $exception) {

            dd($exception);
            return response()->json(([
                'code' => 400,
                'msg' => '发生错误'
            ]), 200);
        }

    }



}
