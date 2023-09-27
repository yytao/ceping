<?php

namespace App\Admin\Actions;
use Encore\Admin\Actions\RowAction;

class webStudentReport extends RowAction
{
    public $name = '查看网页版报告';

    public function href()
    {
        return "/studentReportPage/".$this->row->id;
    }

}
