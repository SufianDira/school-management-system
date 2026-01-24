<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomTeacherController;
use App\Http\Controllers\ClassroomStudentsController;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('me', [AuthController::class, 'me'])->name('me');

    Route::apiResource('students', StudentController::class);
    Route::apiResource('classrooms', ClassroomController::class);

    Route::prefix('classrooms/{classroom}')->group(function () {
        Route::get('teacher', [ClassroomTeacherController::class, 'show'])->name('classroom.teacher.show');
        Route::put('teacher', [ClassroomTeacherController::class, 'assign'])->name('classroom.teacher.assign');
        Route::delete('teacher', [ClassroomTeacherController::class, 'unassign'])->name('classroom.teacher.unassign');

        Route::get('students', [ClassroomStudentsController::class, 'index'])->name('classroom.students.index');
        Route::post('students', [ClassroomStudentsController::class, 'assign'])->name('classroom.students.assign');
        Route::delete('students/{student}', [ClassroomStudentsController::class, 'unassign'])->name('classroom.students.unassign');
    });
});
