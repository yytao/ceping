<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(view("admin.chart1"));
                });

                $row->column(4, function (Column $column) {
                    $column->append(view("admin.chart2"));
                });

                $row->column(4, function (Column $column) {
                    $column->append(view("admin.chart3"));
                });
            });
    }
}
