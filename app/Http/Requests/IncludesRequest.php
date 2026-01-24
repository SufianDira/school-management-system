<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IncludesRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'include' => $this->parseList($this->query('include')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'include' => ['sometimes', 'filled', 'array'],
            'include.*' => ['string', Rule::in($this->allowedIncludes())],
        ];
    }

    protected function allowedIncludes(): array
    {
        return [];
    }

    protected function parseList(mixed $list): ?array
    {
        if (is_string($list)) {
            return str($list)
                ->explode(',')
                ->map(fn ($value) => trim($value))
                ->filter()
                ->unique()
                ->values()
                ->all();
        }

        if (is_array($list)) {
            return collect($list)
                ->map(fn ($value) => trim($value))
                ->filter()
                ->unique()
                ->values()
                ->all();
        }

        return null;
    }

    public function includes(): array
    {
        return $this->validated('include', []);
    }
}
