<?php

namespace App\Http\Requests;

class ShowClassroomRequest extends ShowRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('view', $this->route('classroom'));
    }

    protected function allowedIncludes(): array
    {
        return ['teacher'];
    }
}
