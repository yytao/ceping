<?php

namespace App\Admin\Controllers;

use App\Models\Examination;
use App\Models\Modular;
use App\Models\Question;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class EvaluatingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学校进度';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Examination());

        $grid->filter(function ($filter) {
            $filter->like('school.name', "学校名称");
            $filter->like('grade_type', "学段")->select(config('customParams.modular_grade_type'));
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('试卷名称'))->display(function ($name){

            $count = Question::whereIn('modular_id', $this->modular_rely)->count();
            return "<span style='font-size: 16px !important;'><b>".$name."</b></span><br><span style='font-size: 8px !important;'>(共".$count."题)</span>";
        })->width(150);

        $grid->column('school.name', __('学校名称'))->width(150);
//        $grid->school_rely(__('学校名称'))->width(150)->display(function ($school_rely){
//            $result = School::whereIn('id', $school_rely)->pluck('name')->toArray();
//            return implode('<br />', $result);
//        });

        $grid->column('grade_type', __('学段'))->width(150);

        $grid->modular_rely(__('模块'))->width(200)->display(function ($modular_rely){
            $result = Modular::whereIn('id', $modular_rely)->pluck('name')->toArray();
            $str = "";
            foreach ($result as $k=>$item)
            {
                $str .= "<span class='label label-success'>".$item."</span> &nbsp;";
                if($k > 7){
                    $str .= "...";
                    break;
                }
            }
            return $str;
        });

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

        $form->dateRange('start_date', 'end_date', '起止时间');

        return $form;
    }
}
