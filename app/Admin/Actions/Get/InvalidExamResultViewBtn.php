<?php

namespace App\Admin\Actions\Get;

use Encore\Admin\Actions\RowAction;

class InvalidExamResultViewBtn extends RowAction
{
    public $name = '查看评测卷';

    public function href()
    {
        return "/admin/invalidExam/showResult/".$this->getKey();
    }

}
