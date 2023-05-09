<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = "cp_modular";
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }


    /*
     * 一对多关系
     */
    public function question()
    {
        return $this->hasMany(Question::class, 'modular_id', 'id');
    }

}
