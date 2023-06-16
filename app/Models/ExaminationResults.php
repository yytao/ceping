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

    public function getResultAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }


    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

}
