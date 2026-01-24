<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->whenLoaded('user');
        $classroom = $this->whenLoaded('classroom');

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => $user ? new UserResource($user) : null,
            'date_of_birth' => $this->date_of_birth->format('Y-m-d'),
            'assigned_class_id' => $this->assigned_class_id,
            'classroom' => $classroom ? new ClassroomResource($classroom) : null,
            'grade' => $this->grade,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
