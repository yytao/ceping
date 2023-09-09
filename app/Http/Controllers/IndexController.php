<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Modular;
use App\Models\User;
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

        return redirect("/login");
    }


    /*
     * 显示报告的html页，用来生成pdf
     * 处理数据
     */
    public function schoolReportPage(Request $request, $school_id)
    {
        $examination = Examination::where('school_id', $school_id)->first();
        if(empty($examination)) {
            return "";
        }

        $answerResult = ExaminationResults::where("school_id", $school_id)
            ->where("examination_id", $examination->id)
            ->get()->toArray();
        if(empty($answerResult)) {
            //return "";
        }

        $data = [];
        //学校总人数

        $data["totalStudent"] = User::where("school_id", $school_id)->count();
        $data["totalAnswerResult"] = count($answerResult);
        $data["low"] = 0;
        $data["level1"] = 0;
        $data["level2"] = 0;
        $data["level3"] = 0;
        $data["high"] = 0;

        $examUserIds = [];

        foreach ($answerResult as $key=>$resultItem) {

            $examUserIds[] = $resultItem["user_id"];

            //注意力测试题，如果有一道题得了0分，即判定无效试卷
            $R = array_filter($resultItem["result"], function($subArray) {
                return $subArray['modular_id'] == 18 && $subArray['score'] == 0;
            });
            if($R) {
                //$data["invalidAnswerResult"][] = $answerResult[$k];
                //unset($answerResult[$k]);
                //continue;
            }

            $regularModular = [1,2,3,4,5,6,7,8,9,10,11,12,16];
            $specialModular = [13,14,15];

            $regular = array_filter($resultItem["result"], function($subArray) use ($regularModular) {
                return in_array($subArray['modular_id'], $regularModular);
            });

            $special = array_filter($resultItem["result"], function($subArray) use ($specialModular) {
                return in_array($subArray['modular_id'], $specialModular);
            });

            $data["special"][16] = 0;
            //计算A到L模块所有的题，以及每一个模块的的分数
            foreach ($regularModular as $k=>$item){
                $Y["regular"][$item]["allResult"] = array_filter($regular, function($subArray) use ($item) {
                    return $subArray['modular_id'] == $item;
                });

                $Y["regular"][$item]["sumScore"] = $score = array_sum(array_column($Y["regular"][$item]["allResult"], "score"));

                $Y["regular"][$item]["score"] = round($score / count($Y["regular"][$item]["allResult"]), 4);

                $data["regular"][$item]["low"] = 0;
                $data["regular"][$item]["mid"] = 0;
                $data["regular"][$item]["high"] = 0;
                $data["regular"][$item]["result"] = Modular::find($item);

                if($Y["regular"][$item]["score"] >= 0.73) {
                    $data["regular"][$item]["high"] += 1;

                }else if($Y["regular"][$item]["score"] > 0.27 && $Y["regular"][$item]["score"] < 0.73) {
                    $data["regular"][$item]["mid"] += 1;

                }else if($Y["regular"][$item]["score"] <= 0.27) {
                    $data["regular"][$item]["low"] += 1;
                }

                if($data["regular"][$item]["result"] == "P读写障碍") {

                    $data["special"][16] += 1;

                }

            }

            //计算每个特殊模块题的分数
            foreach ($specialModular as $k=>$item){
                $Y["special"][$item]["allResult"] = array_filter($special, function($subArray) use ($item) {
                    return $subArray['modular_id'] == $item;
                });

                $score = array_sum(array_column($Y["special"][$item]["allResult"], "score"));

                $Y["special"][$item]["score"] = $score;

                $data["special"][$item] = 0;

                if($score == 1) {
                    $data["special"][$item] += 1;
                }
            }

            //各模块的总题数
            $N = array_sum(array_map(function ($item){
                return count($item["allResult"]);
            }, $Y["regular"]));


            //各模块的的分数
            $ni = array_sum(array_column($Y["regular"],"sumScore"));

            $Y["Y"] = round($ni / $N, 4);

            if($Y["Y"] >= 0.73) {
                $data["high"] += 1;
                $data["result"]["high"][$key] = $resultItem;

            }else if($Y["Y"] > 0.5968 && $Y["Y"] < 0.73) {
                $data["level3"] += 1;
                $data["result"]["level3"][$key] = $resultItem;

            }else if($Y["Y"] > 0.4032 && $Y["Y"] <= 0.5968) {
                $data["level2"] += 1;
                $data["result"]["level2"][$key] = $resultItem;

            }else if($Y["Y"] > 0.27 && $Y["Y"] <= 0.4032) {
                $data["level1"] += 1;
                $data["result"]["level1"][$key] = $resultItem;

            }else if($Y["Y"] <= 0.27) {
                $data["low"] += 1;
                $data["result"]["low"][$key] = $resultItem;

            }
        }

        //有效问卷数目
        $data["validAnswerResult"] = count($answerResult);


        //处理常规维度柱状图，每个常规模块的高风险人数
        foreach ($data["regular"] as $k=>$item)
        {
            if($item["result"]->name == "P读写障碍")
                continue;

            $data["school6"]["value"][] = $item["high"];
        }

        //查询没有做试卷的用户
        $data["unExamUser"] = User::whereNotIn("id", $examUserIds)->get()->toArray();

        //dd($data["unExamUser"]);

        return view("admin.school_report", compact(
            "examination",
            "answerResult",
            "data",
        ));
    }

}
