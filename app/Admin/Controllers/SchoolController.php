<?php

namespace App\Admin\Controllers;

use App\Models\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class SchoolController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学校基本信息';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new School());

        $grid->filter(function ($filter) {
            $filter->like('name', "学校");
            $filter->like('campus', "校区");
            $filter->like('phone', "手机号");
        });

        $grid->column('id', __('ID'))->sortable()->width(100);
        $grid->column('name', __('学校名称'))->width(300);
        $grid->column('campus', __('校区'))->width(300);
        $grid->column('grade_type', __('学段'))->width(150);

        $grid->column('contact', __('联系人'))->width(150);
        $grid->column('phone', __('手机号'))->width(200);

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
        $form = new Form(new School());

        $form->text('name', '学校名称')->required();
        $form->text('campus', '校区')->required();
        $form->text('address', '详细地址')->required();
        $form->select('grade_type', '学段')->options(config('customParams.modular_grade_type'))->required();

        $form->text('contact', '联系人')->required();
        $form->mobile('phone', '电话')->required();
        $form->email('email', '邮箱')->required();

        return $form;
    }
}
