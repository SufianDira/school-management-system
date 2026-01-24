<?php

namespace App\Http\Requests;

class ShowRequest extends IncludesRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [

        ]);
    }
}
