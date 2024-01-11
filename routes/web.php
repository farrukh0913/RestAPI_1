<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users',[UserController::class,'getUsers']);

Route::post('/createStudent', [StudentController::class, 'create']);
Route::get('/getAllStudents', [StudentController::class, 'getAllStudents']);
Route::put('/updateStudent/{id}', [StudentController::class, 'updateStudent']);
Route::delete('/deleteStudent/{id}', [StudentController::class, 'deleteStudent']);
