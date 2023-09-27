<?php

namespace App\Admin\Controllers;

use App\Models\Modular;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ModularController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '模块管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Modular());

        $grid->filter(function ($filter) {
            $filter->like('name', "模块名称");
            $filter->like('grade_type', "学段")->select(config('customParams.modular_grade_type'));
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('模块名称'))->width(300);
        $grid->column('grade_type', __('学段'))->display(function ($title){
            return implode(',', $title);
        })->width(300);

        $grid->column('type', __('模块类型'))
            ->using(config('customParams.modular_type'))
            ->label([
                1 => 'success',
                2 => 'warning',
                3 => 'info',
            ])->width(300);

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
        $form = new Form(new Modular());

        $form->text('name', '模块名称')->required();
        $form->multipleSelect('grade_type', '学段')->options(config('customParams.modular_grade_type'))->required();

        $form->table('level', 'Level', function ($table) {
            $table->text('level', '等级');
            $table->text('msg', '评语');
        });
        return $form;
    }
}
