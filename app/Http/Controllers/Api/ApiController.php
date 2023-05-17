<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSchoolByGradeType(Request $request)
    {
        $result = School::select('id', 'name as text')->where('grade_type', 'like', '%'.$request->q.'%')->get()->toArray();
//        dd($result);
        return $result;
    }




}
