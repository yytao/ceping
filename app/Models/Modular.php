<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modular extends Model
{
    protected $table = "cp_modular";
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function getGradeTypeAttribute($value)
    {
        return explode(',', $value);
    }

    public function setGradeTypeAttribute($value)
    {
        $this->attributes['grade_type'] = implode(',', $value);
    }

    /*
     * 一对多关系
     */
    public function question()
    {
        return $this->hasMany(Question::class, 'modular_id', 'id');
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

}
