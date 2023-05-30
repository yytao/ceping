<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "cp_question";
    protected $guarded = [];

    public function getAnswerAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = json_encode(array_values($value));
    }

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function modular()
    {
        return $this->belongsTo(Modular::class, 'modular_id', 'id');
    }

}
