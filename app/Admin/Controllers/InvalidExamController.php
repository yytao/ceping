<?php

namespace App\Admin\Controllers;

use App\Models\InvalidExam;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class InvalidExamController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '无效问卷';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new InvalidExam());

        $grid->disableActions();

        $grid->school_name('学校名称')->width(200);
        $grid->examination_name('试卷名称')->width(200);
        $grid->student_name('学生姓名');
        $grid->type('问卷有效性')->using([1=>'有效', 99=>'无效']);
        $grid->society('社会赞许性');
        $grid->attention('注意力检测题');
        $grid->remark('备注');


        $grid->edit('操作')->default("查看测评卷")->modal('测评卷结果', function (){

            return view('admin.invalidExam.showResult');
        });

        return $grid;
    }

}
