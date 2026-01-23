<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Student;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Student::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('role', 'STUDENT'),
                'unique:students,user_id',
            ],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'assigned_class_id' => ['prohibited'],
            'grade' => ['nullable', 'decimal:0,2', 'between:0,100'],
        ];
    }
}
