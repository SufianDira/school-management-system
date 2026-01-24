<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\StudentResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password') + [
                'role' => 'STUDENT',
            ]);

        $user->student()->create($request->only('date_of_birth') + [
                'assigned_class_id' => null,
                'grade' => null,
            ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->noContent();
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->session()->regenerate();

        return response()->noContent();
    }

    public function logout(Request $request)
    {
        Auth::logout();;

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function me(Request $request)
    {
        $user = $request->user();

        if ($user->isStudent()) {
            $student = Student::query()->where('user_id', $user->id)->with(['user', 'classroom'])->sole();
            return new StudentResource($student);
        } else {
            return new UserResource($user);
        }
    }
}
