<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    //数据看板
    $router->get('departmentDataView', 'DepartmentDataViewController@index');
    $router->get('schoolDataView', 'SchoolDataViewController@index');


    //学校管理
    $router->resource('school', SchoolController::class);

    //学生管理
    $router->resource('student', StudentController::class);

    //试卷管理
    $router->resource('examination', ExaminationController::class);


    //学校进度
    $router->resource('evaluating', EvaluatingController::class);

    //班级进度
    $router->resource('classInfo', ClassInfoController::class);

    //学生做题记录
    $router->resource('invalidExam', InvalidExamController::class);

    //学校评估报告
    $router->resource('schoolReport', SchoolReportController::class);

    //学校评估报告
    $router->resource('studentReport', StudentReportController::class);

    //题库管理
    $router->resource('question', QuestionController::class);

    //模块管理
    $router->resource('modular', ModularController::class);



});
