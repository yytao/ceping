<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Modular;
use App\Models\Question;
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
     * 导入测试用户
     */
    public function insertUser()
    {
        $i = 1;

        return false;
        for(; $i <= 150; $i++)
        {
            $user = new User();
            $user->name = "jxws".str_pad($i, 2, '0', STR_PAD_LEFT);

            $user->gender = "男";
            $user->password = "$2y$10$7zn6S4xKGRY.sXZw4OIdROQjGmRCYwVnT0iG/tl6vBvbOqVTcd4ly";
            $user->school_id = 6;

            $user->id_card = 11;
            $user->year = 2023;
            $user->grade = "一年级";
            $user->class = 1;
            $user->student_id = "123";
            $user->student_code = "123";
            $user->save();
        }

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
            ->get();
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

        $data["result"]["high"] = [];
        $data["result"]["level3"] = [];
        $data["result"]["level2"] = [];
        $data["result"]["level1"] = [];
        $data["result"]["low"] = [];

        //计算前五危险的模块
        $data["highRegular"] = [];
        $data["level3Regular"] = [];
        $data["level2Regular"] = [];
        $data["level1Regular"] = [];
        $data["lowRegular"] = [];
        $data["highSpecial"] = [13=>[], 14=>[], 15=>[]];
        $data["regular"] = [];
        $data["invalidAnswerResult"] = [];
        foreach ($answerResult as $key=>$resultItem) {

            $examUserIds[] = $resultItem["user_id"];

            //注意力测试题，如果有一道题得了0分，即判定无效试卷
            $R = array_filter($resultItem["result"], function($subArray) {
                return $subArray['modular_id'] == 18 && $subArray['score'] == 0;
            });
            if($R) {
                $data["invalidAnswerResult"][$key] = $answerResult[$key];

                $S = array_filter($resultItem["result"], function($subArray) {
                    return $subArray['modular_id'] == 19 && $subArray['score'] == 1;
                });

                $score = array_sum(array_column($S, "score"));

                if($score >= 8)
                {
                    $data["invalidAnswerResult"][$key]->S = "超出阈值";
                }
                $data["invalidAnswerResult"][$key]->S = "正常";

                //查询具体是那些判别题错误
                foreach ($R as $k => $item)
                {
                    $question = Question::find($item['question_id']);
                    $data["invalidAnswerResult"][$key]->wrongTitle .= "[".$question->question."]错误，";
                }

//                dd($data["invalidAnswerResult"]);
                unset($answerResult[$key]);
                continue;
            }

            $regularModular = [1,2,3,4,5,6,7,8,9,10,11,12,16];
            $specialModular = [13,14,15];

            $regular = array_filter($resultItem["result"], function($subArray) use ($regularModular) {
                return in_array($subArray['modular_id'], $regularModular);
            });

            $special = array_filter($resultItem["result"], function($subArray) use ($specialModular) {
                return in_array($subArray['modular_id'], $specialModular);
            });

            $highRegular = [];
            $highSpecial = [];

            //计算A到L模块所有的题，以及每一个模块的的分数
            foreach ($regularModular as $k=>$item){
                $Y["regular"][$item]["allResult"] = array_filter($regular, function($subArray) use ($item) {
                    return $subArray['modular_id'] == $item;
                });

                $Y["regular"][$item]["sumScore"] = $score = array_sum(array_column($Y["regular"][$item]["allResult"], "score"));

                $Y["regular"][$item]["score"] = @round($score / count($Y["regular"][$item]["allResult"]), 4);

                $data["regular"][$item]["result"] = Modular::find($item);

                if($Y["regular"][$item]["score"] >= 0.73) {

                    if($data["regular"][$item]["result"]->name == "P读写障碍") {
                        @$data["special"][16] += 1;
                        $highSpecial[] = $item;
                        continue;
                    }

                    @$data["regular"][$item]["high"] += 1;
                    $highRegular[] = $item;

                }else if($Y["regular"][$item]["score"] > 0.27 && $Y["regular"][$item]["score"] < 0.73) {
                    @$data["regular"][$item]["mid"] += 1;

                }else if($Y["regular"][$item]["score"] <= 0.27) {
                    @$data["regular"][$item]["low"] += 1;
                }

            }

            //计算每个特殊模块题的分数
            foreach ($specialModular as $k=>$item){
                $Y["special"][$item]["allResult"] = array_filter($special, function($subArray) use ($item) {
                    return $subArray['modular_id'] == $item;
                });

                $score = array_sum(array_column($Y["special"][$item]["allResult"], "score"));

                $Y["special"][$item]["score"] = $score;

                if($score == 1) {
                    @$data["special"][$item] += 1;
                    $highSpecial[$item] = $highRegular;

                    @$userSpecial[] = $item;

                    $data["highSpecial"][$item] = array_merge($data["highSpecial"][$item], $highRegular);

                }
            }

            //各模块的总题数
            $N = array_sum(array_map(function ($item){
                return count($item["allResult"]);
            }, $Y["regular"]));


            //各模块的的分数
            $ni = array_sum(array_column($Y["regular"],"sumScore"));

            $Y["Y"] = round($ni / $N, 4);

            $answerResult[$key]->userRegular = $highRegular??[];
            $answerResult[$key]->userSpecial = $userSpecial??[];

            if($Y["Y"] >= 0.73) {
                $data["high"] += 1;
                $data["result"]["high"][$key] = $resultItem;
                $data["highRegular"] = array_merge($data["highRegular"], $highRegular);

            }else if($Y["Y"] > 0.5968 && $Y["Y"] < 0.73) {
                $data["level3"] += 1;
                $data["result"]["level3"][$key] = $resultItem;

                $data["level3Regular"] = array_merge($data["highRegular"], $highRegular);

            }else if($Y["Y"] > 0.4032 && $Y["Y"] <= 0.5968) {
                $data["level2"] += 1;
                $data["result"]["level2"][$key] = $resultItem;

                $data["level2Regular"] = array_merge($data["highRegular"], $highRegular);

            }else if($Y["Y"] > 0.27 && $Y["Y"] <= 0.4032) {
                $data["level1"] += 1;
                $data["result"]["level1"][$key] = $resultItem;

                $data["level1Regular"] = array_merge($data["highRegular"], $highRegular);

            }else if($Y["Y"] <= 0.27) {
                $data["low"] += 1;
                $data["result"]["low"][$key] = $resultItem;

                $data["lowRegular"] = array_merge($data["highRegular"], $highRegular);
            }
        }

        //处理结果然后排序只取前5个
        $data["highRegular"] = array_count_values($data["highRegular"]);
        arsort($data["highRegular"]);
        $data["highRegular"] = array_slice($data["highRegular"], 0, 5, true);

        $data["level3Regular"] = array_count_values($data["level3Regular"]);
        arsort($data["level3Regular"]);
        $data["level3Regular"] = array_slice($data["level3Regular"], 0, 5, true);

        $data["level2Regular"] = array_count_values($data["level2Regular"]);
        arsort($data["level2Regular"]);
        $data["level2Regular"] = array_slice($data["level2Regular"], 0, 5, true);

        $data["level1Regular"] = array_count_values($data["level1Regular"]);
        arsort($data["level1Regular"]);
        $data["level1Regular"] = array_slice($data["level1Regular"], 0, 5, true);

        $data["lowRegular"] = array_count_values($data["lowRegular"]);
        arsort($data["lowRegular"]);
        $data["lowRegular"] = array_slice($data["lowRegular"], 0, 5, true);

        $data["highSpecial"][13] = array_count_values($data["highSpecial"][13]);
        arsort($data["highSpecial"][13]);
        $data["highSpecial"][13] = array_slice($data["highSpecial"][13], 0, 5, true);

        $data["highSpecial"][14] = array_count_values($data["highSpecial"][14]);
        arsort($data["highSpecial"][14]);
        $data["highSpecial"][14] = array_slice($data["highSpecial"][14], 0, 5, true);

        $data["highSpecial"][15] = array_count_values($data["highSpecial"][15]);
        arsort($data["highSpecial"][15]);
        $data["highSpecial"][15] = array_slice($data["highSpecial"][15], 0, 5, true);


        //有效问卷数目
        $data["validAnswerResult"] = count($answerResult);

        //处理常规维度柱状图，每个常规模块的高风险人数
        foreach ($data["regular"] as $k=>$item)
        {
            if($item["result"]->name == "P读写障碍")
                continue;

            @$data["school6"]["value"][] = $item["high"];
        }

        //查询没有做试卷的用户
        $data["unExamUser"] = User::where("school_id", $school_id)->whereNotIn("id", $examUserIds)->get()->toArray();

        return view("admin.school_report", compact(
            "examination",
            "answerResult",
            "data",
        ));
    }



    
    /*
     * 显示报告的html页，用来生成pdf Student
     * 处理数据
     */
    public function studentReportPage(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if(empty($user)) {
            return "";
        }

        $answerResult = ExaminationResults::where("user_id", $user->id)->first();
        if(empty($answerResult)) {
            return "";
        }

        $data = [];

        $regularModular = [1,2,3,4,5,6,7,8,9,10,11,12,16];
        $specialModular = [13,14,15];

        $regular = array_filter($answerResult["result"], function($subArray) use ($regularModular) {
            return in_array($subArray['modular_id'], $regularModular);
        });

        $special = array_filter($answerResult["result"], function($subArray) use ($specialModular) {
            return in_array($subArray['modular_id'], $specialModular);
        });

        $highRegular = [];
        $highSpecial = [];

        //计算A到L模块所有的题，以及每一个模块的的分数
        foreach ($regularModular as $k=>$item){
            $Y["regular"][$item]["allResult"] = array_filter($regular, function($subArray) use ($item) {
                return $subArray['modular_id'] == $item;
            });

            $Y["regular"][$item]["sumScore"] = $score = array_sum(array_column($Y["regular"][$item]["allResult"], "score"));

            $Y["regular"][$item]["score"] = @round($score / count($Y["regular"][$item]["allResult"]), 4);

            if($item == 16 && $Y["regular"][$item]["sumScore"] == 0)
            {
                continue;
            }

            $data["regular"][$item]["result"] = $modular = Modular::find($item);

            if($Y["regular"][$item]["score"] >= 0.73) {
                $msg = array_filter($modular["level"], function($subArray) use ($item) {
                    return $subArray['level'] == "high";
                });
                @$data["regular"][$item]["msg"] = array_column($msg, 'msg')[0]??"无";
                @$data["regular"][$item]["title"] = "风险极高";


            }else if($Y["regular"][$item]["score"] > 0.27 && $Y["regular"][$item]["score"] < 0.73) {
                $msg = array_filter($modular["level"], function($subArray) use ($item) {
                    return $subArray['level'] == "mid";
                });
                @$data["regular"][$item]["msg"] = array_column($msg, 'msg')[0]??"无";
                @$data["regular"][$item]["title"] = "值得关注（建议持续跟进并进一步评估）";

            }else if($Y["regular"][$item]["score"] <= 0.27) {
                $msg = array_filter($modular["level"], function($subArray) use ($item) {
                    return $subArray['level'] == "low";
                });
                @$data["regular"][$item]["msg"] = array_column($msg, 'msg')[0]??"无";
                @$data["regular"][$item]["title"] = "风险极低";
                
            }
        }

        $data["special"] = 0;
        //计算每个特殊模块题的分数
        foreach ($specialModular as $k=>$item){
            $Y["special"][$item]["allResult"] = array_filter($special, function($subArray) use ($item) {
                return $subArray['modular_id'] == $item;
            });

            $score = array_sum(array_column($Y["special"][$item]["allResult"], "score"));

            $Y["special"][$item]["score"] = $score;

            if($score == 1) {
                $data["special"] = $item;
                $data["special_title"] = config("customParams.special_title")[$item];
            }
        }

        /*
            计算Y
        */
        //各模块的总题数
        $N = array_sum(array_map(function ($item){
            return count($item["allResult"]);
        }, $Y["regular"]));
        //各模块的的分数
        $ni = array_sum(array_column($Y["regular"],"sumScore"));
        $data["Y"] = $Y["Y"] = round($ni / $N, 4) * 100;
        if($Y["Y"] >= 0.73) {
            $data["Y_title"] = "风险极高";
            $data["Y_msg"] = "风险极高的提示语，需要提供给我";

        }else if($Y["Y"] > 0.5968 && $Y["Y"] < 0.73) {
            $data["Y_title"] = "三级关注";
            $data["Y_msg"] = "三级关注的提示语，需要提供给我";

        }else if($Y["Y"] > 0.4032 && $Y["Y"] <= 0.5968) {
            $data["Y_title"] = "二级关注";
            $data["Y_msg"] = "二级关注的提示语，需要提供给我";

        }else if($Y["Y"] > 0.27 && $Y["Y"] <= 0.4032) {
            $data["Y_title"] = "一级关注";
            $data["Y_msg"] = "一级关注的提示语，需要提供给我";

        }else if($Y["Y"] <= 0.27) {
            $data["Y_title"] = "风险极低";
            $data["Y_msg"] = "总体而言，该生整体得分处于正常人群的平均分布范围之内，意味着未来校园生活中，该生在心理健康方面出现问题的可能性极低，无需过度关注。";
        }
        
        // dd($data);

        return view("admin.student_report", compact(
            "user",
            "data",
        ));
    }

}
