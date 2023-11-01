<?php

namespace App\Admin\Controllers;

use App\Models\ExaminationResults;
use App\Models\InvalidExam;
use App\Models\Modular;
use App\Models\Question;
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
        $grid->perPages([10]);

        $grid->filter(function ($filter) {
            $filter->like('school_name', "学校名称");
        });

        $grid->school_name('学校名称')->width(200);
        $grid->examination_name('试卷名称')->width(200);
        $grid->student_name('学生姓名');
        $grid->type('问卷有效性')->using([1=>'有效', 99=>'无效']);
        $grid->society('社会赞许性');
        $grid->attention('注意力检测题');
        $grid->remark('备注');

        $grid->edit('操作')->default("查看测评卷")->modal('测评卷结果', function (){
            $ExaminationResults = ExaminationResults::find($this->getkey())??[];
            foreach ($ExaminationResults->result as $k=>$item){
                $item["question"] = Question::find($item['question_id']);

                $result[$item['modular_id']][] = $item;
            }

            foreach ($result as $k=>$item){
                $modular = Modular::find($k);
                $result[$modular->name] = $result[$k];
                unset($result[$k]);
            }

            return view('admin.invalidExam.showResult', compact('result'));
        });

        return $grid;
    }

}
