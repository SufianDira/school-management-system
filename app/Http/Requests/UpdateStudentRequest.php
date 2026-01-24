<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('student'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['prohibited'],
            'date_of_birth' => ['sometimes', 'filled', 'date', 'before:today'],
            'assigned_class_id' => ['prohibited'],
            'grade' => ['sometimes', 'nullable', 'decimal:0,2', 'between:0,100'],
        ];
    }
}
