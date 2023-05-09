<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

use Encore\Admin\Form;
Form::init(function (Form $form) {

    $form->disableEditingCheck();
    $form->disableCreatingCheck();
    $form->disableViewCheck();

    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableView();
        $tools->disableList();
    });
});

use Encore\Admin\Show;
Show::init(function (Show $show) {

    $show->panel()->tools(function ($tools) {
        // 禁用编辑
        $tools->disableEdit();
        // 禁用删除
        $tools->disableDelete();
    });
});

use Encore\Admin\Grid;
Grid::init(function (Grid $grid) {

    $grid->disableExport();
    $grid->actions(function ($actions){
        $actions->disableView();
    });

    $grid->filter(function ($filter) {
        $filter->disableIdFilter();
    });

});

Admin::css('/common/css/laravel-admin.css');
