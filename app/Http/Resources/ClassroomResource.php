<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $teacher = $this->whenLoaded('teacher');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'teacher_id' => $this->teacher_id,
            'teacher' => $teacher ? new UserResource($teacher) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
