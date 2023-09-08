<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return view("examination", compact(
            'examination',
            'user',
        ));
    }


    /*
     * 页面刷新时，获取所有问题
     */
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

        $question = DB::table('cp_question as cq')
            ->select('cq.id', 'cm.status', 'cq.question', 'cq.modular_id', DB::raw("JSON_EXTRACT(cq.answer, '$') as answer"), 'cm.trigger_modular_id', 'cm.trigger_modular_value')
            ->leftJoin('cp_modular as cm', 'cq.modular_id', '=', 'cm.id')
            ->where('cm.type', '=', '1')
            ->whereIn('cq.modular_id', $examination->modular_rely)->get()->toArray();
        $question = json_decode(json_encode($question), true);

        $question = array_map(function ($row) {
            $row['answer'] = $this->processValue($row['answer']);
            return $row;
        }, $question);

        shuffle($question);

        $interference = DB::table('cp_question as cq')
            ->select('cq.id', 'cm.status', 'cq.question', 'cq.modular_id', DB::raw("JSON_EXTRACT(cq.answer, '$') as answer"), 'cm.trigger_modular_id', 'cm.trigger_modular_value')
            ->leftJoin('cp_modular as cm', 'cq.modular_id', '=', 'cm.id')
            ->where('cm.type', '=', '2')
            ->whereIn('cq.modular_id', $examination->modular_rely)->get()->toArray();
        $interference = json_decode(json_encode($interference), true);
        $interference = array_map(function ($row) {
            $row['answer'] = $this->processValue($row['answer']);
            return $row;
        }, $interference);
        if(!empty($interference))
        {
            $question = $this->insertArray($question, $interference);
        }

        return response()->json(([
            'code' => 200,
            'data' => $question,
            'msg' => '成功'
        ]), 200);

    }

    public function processValue($value)
    {
        return json_decode($value, true) ?: [];
    }

    public function insertArray($bigArray, $smallArray)
    {
        $n = count($bigArray);
        $m = count($smallArray);
        $interval = floor($n * 0.3);

        array_splice($bigArray, $interval, 0, array($smallArray[0]));

        $interval = floor($n * 0.6);

        array_splice($bigArray, $interval, 0, array($smallArray[1]));

        $interval = floor($n * 0.9);

        array_splice($bigArray, $interval, 0, array($smallArray[2]));

        return $bigArray;
    }

    /*
     * 第一个提交
     * 验证钩子问题
     */
    public function resultSubmit(Request $request)
    {
        $result = $request->input('result');

        $isExtra = false;

        $whereOne = array_filter($result, function($subArray) {
            return $subArray['modular_id'] == 3 && $subArray['score'] == 1;
        });
        $question['A'] = [];

        if(floor(count($whereOne) / 5) >= 0.73)
        {
            $question['A'] = DB::table('cp_question as cq')
                ->select('cq.id', 'cq.question', 'cm.status', 'cq.modular_id', DB::raw("JSON_EXTRACT(cq.answer, '$') as answer"), 'cm.trigger_modular_id', 'cm.trigger_modular_value')
                ->leftJoin('cp_modular as cm', 'cq.modular_id', '=', 'cm.id')
                ->whereIn('cq.modular_id', [13,14,15])->get()->toArray();

            $question['A'] = json_decode(json_encode($question['A']), true);
            $question['A'] = array_map(function ($row) {
                $row['answer'] = $this->processValue($row['answer']);
                return $row;
            }, $question['A']);

            $isExtra = true;
        }

        $whereTwo = array_filter($result, function($subArray) {
            return $subArray['modular_id'] == 5 && $subArray['score'] == 1;
        });
        $question['B'] = [];
        if(floor(count($whereTwo) / 5) >= 0.73)
        {
            $question['B'] = DB::table('cp_question as cq')
                ->select('cq.id', 'cq.question', 'cm.status', 'cq.modular_id', DB::raw("JSON_EXTRACT(cq.answer, '$') as answer"), 'cm.trigger_modular_id', 'cm.trigger_modular_value')
                ->leftJoin('cp_modular as cm', 'cq.modular_id', '=', 'cm.id')
                ->whereIn('cq.modular_id', [16])->get()->toArray();

            $question['B'] = json_decode(json_encode($question['B']), true);
            $question['B'] = array_map(function ($row) {
                $row['answer'] = $this->processValue($row['answer']);
                return $row;
            }, $question['B']);
            $isExtra = true;
        }

        if($isExtra)
        {
            return response()->json(([
                'code' => 300,
                'data' => $question,
                'msg' => '继续做题'
            ]), 200);
        }

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

            return response()->json(([
                'code' => 400,
                'msg' => '发生错误'
            ]), 200);
        }
    }


    /*
     * 第二次提交
     */
    public function resultSubmitExtra(Request $request)
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

            return response()->json(([
                'code' => 400,
                'msg' => '发生错误'
            ]), 200);
        }
    }
}
