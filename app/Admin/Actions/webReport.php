<?php

namespace App\Admin\Actions;
use Encore\Admin\Actions\RowAction;

class webReport extends RowAction
{
    public $name = '查看网页版报告';

    public function href()
    {
        return "/schoolReportPage/".$this->row->school_id;
    }

}
