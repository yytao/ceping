<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = "cp_school";
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function getSelectOptions()
    {
        $result = self::get();
        $return = [];
        foreach ($result as $k=>$item)
        {
            $return[$item->id] = $item->name;
        }

        return $return;
    }

    public function getSelectOptionsByGrade($grade = "")
    {
        $result = self::where('grade_type', 'like', "%$grade%")->get();
        $return = [];
        foreach ($result as $k=>$item)
        {
            $return[$item->id] = $item->name;
        }

        return $return;
    }

}
