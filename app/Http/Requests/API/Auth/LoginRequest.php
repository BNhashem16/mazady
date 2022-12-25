<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\JsonRequest;

class LoginRequest extends JsonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
