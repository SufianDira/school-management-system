<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomTeacherController;
use App\Http\Controllers\ClassroomStudentsController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('classrooms', ClassroomController::class);

    Route::prefix('classrooms/{classroom}')->group(function () {
        Route::get('teacher', [ClassroomTeacherController::class, 'show']);
        Route::put('teacher', [ClassroomTeacherController::class, 'assign']);
        Route::delete('teacher', [ClassroomTeacherController::class, 'unassign']);

        Route::get('students', [ClassroomStudentsController::class, 'index']);
        Route::post('students', [ClassroomStudentsController::class, 'assign']);
        Route::delete('students/{student}', [ClassroomStudentsController::class, 'unassign']);
    });
});
