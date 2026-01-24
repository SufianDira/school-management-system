<?php

namespace App\Http\Requests;

use App\Models\Classroom;

class IndexClassroomsRequest extends IndexRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Classroom::class);
    }

    protected function allowedIncludes(): array
    {
        return ['teacher'];
    }
}
