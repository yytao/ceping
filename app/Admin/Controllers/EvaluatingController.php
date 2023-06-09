<?php

namespace App\Admin\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResults;
use App\Models\Modular;
use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\MessageBag;

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
        $grid = new Grid(new ExaminationResults());

        $grid->filter(function ($filter) {

        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('examination.name', __('试卷名称'))->width(150);
        $grid->column('school', __('试卷名称'))->width(150);


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
