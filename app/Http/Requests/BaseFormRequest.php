<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class BaseFormRequest extends FormRequest
{
    public function validatedExcept(string | array $keys): array
    {
        return Arr::except($this->validated(), $keys);
    }
}
