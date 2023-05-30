<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\QuestionScore;
use App\Models\Modular;
use App\Models\Question;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class QuestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '试题管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Question());

        $grid->filter(function ($filter) {
            $filter->equal('modular_id', "模块")->select(Modular::getSelectOptions());
            $filter->like('modular.grade_type', "学段")->select(config('customParams.modular_grade_type'));
        });

        $grid->column('id', __('ID'))->sortable()->width(50);
        $grid->column('question', __('题目名称'))->width(450);
        $grid->column('answer', __('计分方式'))->display(function ($answer){
            $result = "";
            foreach ($answer as $k=>$item){
                $result .= $item["title"]." = ".$item["score"]."分<br />";
            }
            return $result;

        })->width(300);
        $grid->column('modular.name', __('模块'))->width(300);
        $grid->column('modular.grade_type', __('学段'))->display(function ($title){
            return implode(',', $title);
        })->width(300);


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
        $form = new Form(new Question());

        $form->text('question', '题目名称')->required();
        $form->select('modular_id', '模块')->options(Modular::getSelectOptions())->required();

        $data = [['title'=>'是', 'score'=>'1', '_remove_' => '0'], ['title'=>'否', 'score'=>'0', '_remove_' => '0']];
        $form->table('answer', '选项', function ($table) {
            $table->text('title', '选项');
            $table->number('score', '分数');
        })->value($data);

        return $form;
    }
}
