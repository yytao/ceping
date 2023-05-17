<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = "cp_examination";
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }


    /*
     * 一对一关系
     */
    public function school()
    {
        return $this->hasOne(School::class, 'school_id', 'id');
    }

}
