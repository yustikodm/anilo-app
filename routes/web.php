<?php

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'scores');

Route::get('students', [StudentController::class, 'index'])->name('students');
Route::post('students/store', [StudentController::class, 'store']);
Route::put('students/update', [StudentController::class, 'update']);
Route::delete('students/delete', [StudentController::class, 'destroy']);

Route::get('subjects', [SubjectController::class, 'index'])->name('subjects');
Route::post('subjects/store', [SubjectController::class, 'store']);
Route::put('subjects/update', [SubjectController::class, 'update']);
Route::delete('subjects/delete', [SubjectController::class, 'destroy']);

Route::get('scores', [ScoreController::class, 'index'])->name('scores');
Route::post('scores/store', [ScoreController::class, 'store']);
Route::put('scores/update', [ScoreController::class, 'update']);
Route::delete('scores/delete', [ScoreController::class, 'destroy']);
