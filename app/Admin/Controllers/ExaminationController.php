<?php

namespace App\Admin\Controllers;

use App\Models\Examination;
use App\Models\Modular;
use App\Models\Question;
use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\MessageBag;


class ExaminationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '试卷管理';

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

        $grid->column('id', __('ID'))->sortable()->width(50);
        $grid->column('name', __('试卷名称'))->display(function ($name){

            $count = Question::whereIn('modular_id', $this->modular_rely)->count();
            return "<span style='font-size: 16px !important;'><b>".$name."</b></span><br><span style='font-size: 8px !important;'>(共".$count."题)</span>";
        })->width(200);

        $grid->column('school.name', __('学校名称'))->width(200);
//        $grid->school_rely(__('学校名称'))->width(150)->display(function ($school_rely){
//            $result = School::whereIn('id', $school_rely)->pluck('name')->toArray();
//            return implode('<br />', $result);
//        });

        $grid->column('grade_type', __('学段'))->width(100);

        $grid->modular_rely(__('模块'))->width(400)->display(function ($modular_rely){
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

//        $grid->column('rating', __('完成率'))->display(function (){
//            return $this->rating."%";
//        })->width(150);

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
        $form->saving(function (Form $form) {

            if(empty($form->modular_rely) || empty(@$form->modular_rely[0]))
            {
                $error = new MessageBag([
                    'title'   => '发生错误',
                    'message' => '必须选择至少一个模块！',
                ]);

                return back()->with(compact('error'));
            }
        });

        $form->text('name', '试卷名称')->required();
        $form->radioCard('grade_type', '学段')
            ->options(config('customParams.modular_grade_type'))
            ->when('小学', function (Form $form){

                $form->radio('school_id', '学校')->options(School::getSelectOptionsByGrade('小学'))->required();
            })->when('初中', function (Form $form){

                $form->radio('school_id', '学校')->options(School::getSelectOptionsByGrade('初中'))->required();
            })->when('高中', function (Form $form){

                $form->radio('school_id', '学校')->options(School::getSelectOptionsByGrade('高中'))->required();
            })->required();

        $form->checkbox('modular_rely', __('模块'))->options(Modular::getSelectOptions());

        $form->number('exam_time', __('考试时长(分钟)'))->default(60)->max(300)->required();
        return $form;
    }
}
