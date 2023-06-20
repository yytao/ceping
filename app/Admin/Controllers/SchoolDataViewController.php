<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class SchoolDataViewController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->row(function (Row $row) {

                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024');
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024');
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024');
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024');
                    $column->append($infoBox->render());
                });

            })->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append(view("admin.schoolDataView.chart1"));
                });

                $row->column(6, function (Column $column) {
                    $column->append(view("admin.schoolDataView.chart2"));
                });

            })->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append(view("admin.schoolDataView.chart3"));
                });
                $row->column(6, function (Column $column) {
                    $column->append(view("admin.schoolDataView.chart4"));
                });
            })->row(function (Row $row) {

                $row->column(11, function (Column $column) {
                    $column->append(view("admin.schoolDataView.chart5"));
                });
            });
    }
}
