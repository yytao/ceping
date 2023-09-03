<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Modular;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Knp\Snappy\Pdf;


class IndexController extends Controller
{
    //

    public function index()
    {
        if(Auth::check()) {
            return redirect("/user");
        }

        return redirect("/user");

        return view("index");
    }

    public function exam()
    {
        return view("exam_page");
    }


    public function generate($school_id)
    {

        $examination = Examination::where("school_id", $school_id)->first();
        if(!empty($examination->report_file)) {
            dd("error");
        }

        $snappy = new Pdf(base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'));
        $snappy->generateFromHtml('<p>Some content</p>', base_path("/storage/app/report").'/report'.$school_id.'.pdf');

        //$snappy->generateFromHtml($html, base_path("/storage/app/report").'/report'.$school_id.'.pdf');

    }


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

        foreach ($answerResult as $key=>$resultItem) {

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

        $data["validAnswerResult"] = count($answerResult);

        return view("admin.school_report", compact(
            "examination",
            "answerResult",
            "data",


        ));
    }

}
