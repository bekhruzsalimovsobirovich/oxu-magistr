<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Specialities\SpecialityController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login',[AuthController::class,'login']);
Route::post('students',[StudentController::class,'store']);

Route::get('subjects/{speciality_id}',[SubjectController::class,'getAll']);
Route::get('specialities',[SpecialityController::class,'getAll']);

Route::group(['prefix' => 'admin','middleware' => ['auth:sanctum','role:admin']], function (){
    Route::get('students',[StudentController::class,'paginate']);
    Route::get('export/students',[StudentController::class,'export']);
    Route::delete('students/{student}',[StudentController::class,'destroy']);
    Route::get('specialities',[SpecialityController::class,'paginate']);
    Route::post('specialities',[SpecialityController::class,'store']);
    Route::apiResource('subjects',SubjectController::class);
});
