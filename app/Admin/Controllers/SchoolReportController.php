<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\generateReport;
use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Modular;
use App\Models\Question;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Http\Request;

class SchoolReportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学校评估报告';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Examination());

        $grid->disableCreateButton();

        $grid->filter(function ($filter) {
            $filter->like('school.name', "学校名称");
            $filter->like('grade_type', "学段")->select(config('customParams.modular_grade_type'));
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
            $actions->add(new generateReport());
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('试卷名称'))->display(function ($name){

            $count = Question::whereIn('modular_id', $this->modular_rely)->count();
            return "<span style='font-size: 16px !important;'><b>".$name."</b></span><br><span style='font-size: 8px !important;'>(共".$count."题)</span>";
        })->width(150);

        $grid->column('school.name', __('学校名称'))->width(150);

        $grid->start_date('测评起止时间')->display(function (){
            return ($this->start_date??'--')." 至 ".($this->end_date??'--');
        })->width(200);

        $grid->end_date('剩余有效天数')->display(function (){
            $datetime1 = new \DateTime(date("Y-m-d"));
            $datetime2 = new \DateTime($this->end_date);
            $interval = $datetime1->diff($datetime2);
            return $interval->format('%a天');

        })->width(200);

        $grid->column('rating', __('完成率'))->display(function (){
            return $this->rating;
        })->progressBar();

        $grid->column('report_file', __('下载报告'))->downloadable();

        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('修改时间'));

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Examination());

        return $form;
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
