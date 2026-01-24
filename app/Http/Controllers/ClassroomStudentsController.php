<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Http\Requests\AssignStudentToClassroomRequest;
use App\Http\Requests\IndexStudentsRequest;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Response;

class ClassroomStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexStudentsRequest $request, Classroom $classroom)
    {
        $this->authorize('manageStudents', $classroom);

        $students = Student::query()
            ->where('assigned_class_id', $classroom->id)
            ->with($request->includes());

        return StudentResource::collection(
            $students->paginate($request->perPage())->appends($request->except('page'))
        );
    }

    public function assign(AssignStudentToClassroomRequest $request, Classroom $classroom)
    {
        $student = Student::findOrFail($request->validated('student_id'));
        $student->update(['assigned_class_id' => $classroom->id]);

        return new StudentResource($student->load(['classroom']));
    }

    public function unassign(Classroom $classroom, Student $student)
    {
        $this->authorize('manageStudents', $classroom);

        if ($student->assigned_class_id !== $classroom->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $student->update(['assigned_class_id' => null]);

        return new StudentResource($student);
    }
}
