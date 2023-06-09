<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationResults extends Model
{
    protected $table = "cp_examination_results";
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }


    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }

    public function school()
    {
        return $this->hasMany(School::class, 'id', 'school_id');
    }

}
