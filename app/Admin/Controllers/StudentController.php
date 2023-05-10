<?php

namespace App\Admin\Controllers;

use App\Models\School;
use App\Models\Student;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class StudentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学生基本信息';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student());

        $grid->filter(function ($filter) {
            $filter->like('school.name', "学校");
            $filter->like('class', "班级");
            $filter->like('name', "姓名");
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('姓名'))->width(300);
        $grid->column('class', __('学校/年级/班级'))->display(function (){
            return $this->school->name." / ".$this->grade." / ".$this->class;
        })->width(300);

        $grid->column('student_id', __('学校内部学号'))->width(300);
        $grid->column('student_code', __('学籍号'))->width(300);

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
        $form = new Form(new Student());

        $form->text('name', '姓名')->required();
        $form->text('id_card', '身份证号')->required();
        $form->select('school_id', '学校')->options(School::getSelectOptions())->required();
        $form->text('year', '届')->required();
        $form->select('grade', '年级')->options(config('customParams.student_grade'))->required();
        $form->text('class', '班级')->required();
        $form->text('student_id', '学校内部学号')->required();
        $form->text('student_code', '学籍号')->required();

        return $form;
    }
}
