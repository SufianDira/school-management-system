<?php

return [
    'teachers_count' => (int) env('SEED_TEACHERS_COUNT', 6),
    'classrooms_per_teacher' => (int) env('SEED_CLASSROOMS_PER_TEACHER', 2),
    'students_per_classroom' => (int) env('SEED_STUDENTS_PER_CLASSROOM', 10),
];
