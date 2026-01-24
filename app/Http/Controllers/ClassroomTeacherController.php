<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\AssignTeacherToClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;

class ClassroomTeacherController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        $this->authorize('view', $classroom);

        return new UserResource($classroom->teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function assign(AssignTeacherToClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update([
            'teacher_id' => $request->validated('teacher_id'),
        ]);

        return new ClassroomResource($classroom->load('teacher'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function unassign(Classroom $classroom)
    {
        $this->authorize('manageTeacher', $classroom);

        $classroom->update(['teacher_id' => null]);

        return response()->noContent();
    }
}
