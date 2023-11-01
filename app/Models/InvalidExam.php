<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class InvalidExam extends Model
{
    protected $guarded = [];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function paginate()
    {
        $perPage = Request::get('per_page', 5);

        $page = Request::get('page', 1);
        $school_name = Request::get('school_name', null);

        $start = ($page-1)*$perPage;

        $sql = 'SELECT cp_er.id as id
                FROM cp_examination_results cp_er
                JOIN users cp_u ON cp_er.user_id = cp_u.id
                JOIN cp_examination cp_e ON cp_er.examination_id = cp_e.id
                JOIN cp_school cp_s ON cp_er.school_id = cp_s.id ';
        if ($school_name){
            $sql .= 'WHERE cp_s.name like "%'.$school_name.'%"';
        }

        $count = DB::select($sql);

        // 运行sql获取数据数组
        $sql = 'SELECT cp_s.name AS school_name, cp_e.name AS examination_name,
                cp_u.name AS student_name, cp_er.type as type, cp_e.id as examination_id, cp_er.result as examResult,
                cp_er.id as id
                FROM cp_examination_results cp_er
                JOIN users cp_u ON cp_er.user_id = cp_u.id
                JOIN cp_examination cp_e ON cp_er.examination_id = cp_e.id
                JOIN cp_school cp_s ON cp_er.school_id = cp_s.id';

        if ($school_name){
            $sql .= ' WHERE cp_s.name like "%'.$school_name.'%"';
        }
        $sql .= ' limit  '.$start.', '.$perPage;

        $result = DB::select($sql);

        $movies = static::hydrate($result);

        $paginator = new LengthAwarePaginator($movies, count($count), $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }

}
