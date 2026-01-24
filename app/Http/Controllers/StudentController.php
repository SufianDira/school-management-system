<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowStudentRequest;
use App\Models\Student;
use App\Http\Requests\IndexStudentsRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\User;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexStudentsRequest $request)
    {
        $students = Student::query()->with($request->includes());

        $user = $request->user();
        if ($user?->isTeacher()) {
            $students->whereHas('classroom', fn($query) => $query->where('teacher_id', $user->id));
        }

        return StudentResource::collection(
            $students->paginate($request->perPage())->appends($request->except('page'))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password') + [
                'role' => 'STUDENT',
            ]);

        $student = $user->student()->create($request->only('date_of_birth', 'grade') + [
                'assigned_class_id' => null,
            ]);

        return (new StudentResource($student->load('user')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowStudentRequest $request, Student $student)
    {
        return new StudentResource($student->load($request->includes()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $user = $student->user()->update($request->only('name', 'email', 'password'));

        $student->update($request->only('date_of_birth', 'grade') + [
                'assigned_class_id' => null,
            ]);

        return new StudentResource($student->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        $student->delete();

        return response()->noContent();
    }
}
