<?php

namespace App\Admin\Controllers;

use App\Models\Examination;
use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

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

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('试卷名称'))->width(200);
        $grid->column('school.name', __('学校名称'))->width(200);
        $grid->column('grade_type', __('学段'))->width(200);
        $grid->column('modular_rely', __('模块'))->width(200);

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

        $form->text('name', '试卷名称')->required();
        $form->radioCard('grade_type', '学段')
            ->options(config('customParams.modular_grade_type'))
            ->when('小学', function (Form $form){

                $form->checkbox('school_rely', '学校')->options(School::getSelectOptionsByGrade('小学'));
            })->when('初中', function (Form $form){

                $form->checkbox('school_rely', '学校')->options(School::getSelectOptionsByGrade('初中'));
            })->when('高中', function (Form $form){

                $form->checkbox('school_rely', '学校')->options(School::getSelectOptionsByGrade('高中'));
            })->required();

        
        return $form;
    }
}
