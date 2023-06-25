<?php

namespace App\Admin\Controllers;

use App\Models\ClassInfo;
use App\Models\Examination;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ClassInfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '班级进度';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ClassInfo());

        $grid->disableActions();

        $grid->examination_name('试卷名称');
        $grid->school_name('学校名称');
        $grid->year('届');
        $grid->grade('年级');
        $grid->class('班级');

        $grid->rating('完成率')->display(function (){
            return $this->rating;
        })->progressBar();
        $grid->total_students('人数');

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
