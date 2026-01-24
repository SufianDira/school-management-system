<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\IndexClassroomsRequest;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\ShowClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexClassroomsRequest $request)
    {
        $classrooms = Classroom::query()->with($request->includes());

        $user = $request->user();
        if ($user?->isTeacher()) {
            $classrooms->where('teacher_id', $user->id);
        }

        return ClassroomResource::collection(
            $classrooms->paginate($request->perPage())->appends($request->except('page'))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create($request->validated());

        return (new ClassroomResource($classroom))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowClassroomRequest $request, Classroom $classroom)
    {
        return new ClassroomResource($classroom->load($request->includes()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        return new ClassroomResource($classroom);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $this->authorize('delete', $classroom);

        $classroom->delete();

        return response()->noContent();
    }
}
