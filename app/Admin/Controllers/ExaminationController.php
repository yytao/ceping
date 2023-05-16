<?php

namespace App\Admin\Controllers;

use App\Models\Examination;
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
            $filter->like('name', "模块名称");
            $filter->like('grade_type', "学段")->select(config('customParams.modular_grade_type'));
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('模块名称'))->width(300);



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

        $form->text('name', '模块名称')->required();
        $form->multipleSelect('grade_type', '学段')->options(config('customParams.modular_grade_type'))->required();

        return $form;
    }
}
