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

//    public function getSchoolRelyAttribute($value)
//    {
//        return explode(',', $value);
//    }
//
//    public function setSchoolRelyAttribute($value)
//    {
//        $this->attributes['school_rely'] = implode(',', $value);
//    }


    public function getModularRelyAttribute($value)
    {
        return explode(',', $value);
    }

    public function setModularRelyAttribute($value)
    {
        $this->attributes['modular_rely'] = implode(',', $value);
    }


    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

    public function getRatingAttribute()
    {

        $schoolPeople = User::where('school_id', $this->school_id)->pluck('id')->toArray();

        $finishPeople = ExaminationResults::whereIn('user_id', $schoolPeople)->where('examination_id', $this->id)->get();

        return ($finishPeople->count() / count($schoolPeople)) * 100;
    }
}
