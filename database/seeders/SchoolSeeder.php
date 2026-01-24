<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $teachersCount = config('seed.teachers_count');
            $classroomsPerTeacher = config('seed.classrooms_per_teacher');
            $studentsPerClassroom = config('seed.students_per_classroom');

            User::factory()->admin()->create([
                'name' => 'Admin',
                'email' => 'admin@test.com',
            ]);

            User::factory()->teacher()->create([
                'name' => 'Teacher',
                'email' => 'teacher@test.com',
            ]);

            User::factory()->student()->create([
                'name' => 'Student',
                'email' => 'student@test.com',
            ]);

            User::factory()->teacher()->count($teachersCount)
                ->has(
                    Classroom::factory()->count($classroomsPerTeacher)
                        ->has(Student::factory()->count($studentsPerClassroom))
                )
                ->create();
        });
    }
}
