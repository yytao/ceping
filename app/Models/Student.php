<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "cp_student";
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

}
