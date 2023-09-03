<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExaminationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, "index"]);

Route::get('/login', [LoginController::class, "loginView"])->name('loginView');
Route::post('/login', [LoginController::class, "login"])->name('login');
Route::get('/logout', [LoginController::class, "logout"])->name('logout');

Route::get('/generate/{school_id}', [IndexController::class, "generate"])->name('generate');

Route::get('/schoolReportPage/{school_id}', [IndexController::class, "schoolReportPage"])->name('schoolReportPage');


Route::group(['middleware'=>['auth']], function() {

    Route::get('/user', [UsersController::class, "index"]);
    Route::get('/exam/{exam_id}', [ExaminationController::class, "index"]);
    Route::post('/exam/getQuestion', [ExaminationController::class, "getQuestion"]);
    Route::post('/exam/result', [ExaminationController::class, "resultSubmit"]);
    Route::post('/exam/resultExtra', [ExaminationController::class, "resultSubmitExtra"]);



});
