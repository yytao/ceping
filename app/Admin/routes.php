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

    $router->resource('question', QuestionController::class);
    $router->resource('modular', ModularController::class);
    $router->resource('examination', ExaminationController::class);

    $router->resource('school', SchoolController::class);
    $router->resource('student', StudentController::class);

});
