<?php

namespace App\Http\Requests;

class IndexRequest extends IncludesRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'page' => ['sometimes', 'filled', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'filled', 'integer', 'min:1', 'max:' . config('api.index.per_page_max')],
        ]);
    }

    public function perPage(): int
    {
        return (int) $this->validated('per_page', config('api.index.per_page_default'));
    }
}
