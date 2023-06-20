<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modular;
use App\Models\School;
use App\Models\User;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class DepartmentDataViewController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->row(function (Row $row) {

                $row->column(3, function (Column $column) {
                    $count = School::count();

                    $infoBox = new InfoBox('学校', 'users', 'aqua', '', 112);
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {

                    $count = User::count();
                    $infoBox = new InfoBox('学生', 'users', 'green', '', 6830);
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {

                    $infoBox = new InfoBox('教师', 'users', 'orange', '', 780);
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {

                    $infoBox = new InfoBox('异常问卷', 'users', 'red', '', 186);
                    $column->append($infoBox->render());
                });

            })->row(function (Row $row) {
                $row->column(6, function (Column $column) {


                    $column->append(view("admin.departmentDataView.chart1"));
                });

                $row->column(6, function (Column $column) {
                    $result = Modular::get();

                    $column->append(view("admin.departmentDataView.chart2", compact('result')));
                });

            })->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append(view("admin.departmentDataView.chart3"));
                });
                $row->column(6, function (Column $column) {
                    $column->append(view("admin.departmentDataView.chart4"));
                });
            })->row(function (Row $row) {

                $row->column(11, function (Column $column) {
                    $column->append(view("admin.departmentDataView.chart5"));
                });
            });
    }
}
