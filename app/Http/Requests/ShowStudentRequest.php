<?php

namespace App\Http\Requests;

class ShowStudentRequest extends ShowRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('view', $this->route('student'));
    }

    protected function allowedIncludes(): array
    {
        return ['user', 'classroom', 'classroom.teacher'];
    }
}
