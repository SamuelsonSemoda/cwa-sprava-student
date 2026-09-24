<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');

Route::resource('tasks', TaskController::class)->except(['show']);
Route::resource('students', StudentController::class);
Route::resource('grades', GradeController::class)->except(['show']);
