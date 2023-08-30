<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Support\Facades\Auth;
use Knp\Snappy\Pdf;


class IndexController extends Controller
{
    //

    public function index()
    {
        if(Auth::check()) {
            return redirect("/user");
        }

        return redirect("/user");

        return view("index");
    }

    public function exam()
    {
        return view("exam_page");
    }


    public function generate($school_id)
    {

        $examination = Examination::where("school_id", $school_id)->first();
        if(!empty($examination->report_file)) {
            dd("error");
        }

        $snappy = new Pdf(base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'));
        $snappy->generateFromHtml('<p>Some content</p>', base_path("/storage/app/report").'/report'.$school_id.'.pdf');

        //$snappy->generateFromHtml($html, base_path("/storage/app/report").'/report'.$school_id.'.pdf');



    }

}
