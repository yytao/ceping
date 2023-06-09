<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ClassInfo extends Model
{
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function paginate()
    {
        $perPage = Request::get('per_page', 10);

        $page = Request::get('page', 1);

        $start = ($page-1)*$perPage;

        // 运行sql获取数据数组
        $sql = 'SELECT s.id as school_id, e.id as examination_id, e.name AS examination_name, s.name AS school_name, u.year, u.grade, u.class, COUNT(u.name) AS total_students
                FROM cp_examination e
                JOIN cp_school s ON e.school_id = s.id
                JOIN users u ON u.school_id = s.id
                GROUP BY e.id, e.name, s.name, s.id, u.year, u.grade, u.class;';

        $result = DB::select($sql);

        $movies = static::hydrate($result);

        $paginator = new LengthAwarePaginator($movies, count($result), $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }

    public function getRatingAttribute()
    {

        $schoolPeople = User::where('school_id', $this->school_id)
            ->where('year', $this->year)
            ->where('grade', $this->grade)
            ->where('class', $this->class)
            ->pluck('id')
            ->toArray();

        $finishPeople = ExaminationResults::whereIn('user_id', $schoolPeople)
            ->where('examination_id', $this->examination_id)->get();

        return ($finishPeople->count() / count($schoolPeople)) * 100;
    }


}
