<?php

namespace App\Http\Requests;

use App\Models\Student;

class IndexStudentsRequest extends IndexRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Student::class);
    }

    protected function allowedIncludes(): array
    {
        return ['user', 'classroom', 'classroom.teacher'];
    }
}
