<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\generateStudentReport;
use App\Admin\Actions\deleteStudentReport;
use App\Admin\Actions\webStudentReport;
use App\Models\ExaminationResults;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class StudentReportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学生评估报告';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->disableCreateButton();

        $grid->filter(function ($filter) {
            $filter->like('school.name', "学校名称");
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
            $actions->add(new generateStudentReport());
            $actions->add(new webStudentReport());
            $actions->add(new deleteStudentReport());
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('school.name', __('学校名称'))->width(150);

        $grid->column('name', __('学生名称'))->width(150);
        $grid->column('grade', __('年级'))->width(150);
        $grid->column('class', __('班级'))->width(150);
        
        $grid->column('column', __('是否做完测试'))->display(function (){
            
            $result = ExaminationResults::where("user_id", $this->id)->first();
            
            return empty($result)? "未完成" : "已完成";
        });
    
        $grid->column('report_file', __('下载报告'))->downloadable();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        return $form;
    }



}
