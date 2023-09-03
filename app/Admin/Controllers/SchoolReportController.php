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



}
