<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formRequest extends FormRequest
{
    public function store(): array
    {
        return [
            'name' => 'required',
            'country' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
