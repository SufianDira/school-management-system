<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;
use App\Models\Classroom;

class ClassroomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTeacher();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Classroom $classroom): bool
    {
        return $user->isAdmin()
            || ($user->isTeacher() && $classroom->teacher_id === $user->id)
            || ($user->isStudent() && $classroom->id === $user->assigned_class_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classroom $classroom): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classroom $classroom): bool
    {
        return $user->isAdmin();
    }

    public function manageTeacher(User $user, Classroom $classroom): bool
    {
        return $user->isAdmin();
    }

    public function manageStudents(User $user, Classroom $classroom): bool
    {
        return $user->isAdmin()
            || ($user->isTeacher() && $classroom->teacher_id === $user->id);
    }
}
