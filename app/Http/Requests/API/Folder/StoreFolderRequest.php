<?php

namespace App\Http\Requests\API\Folder;

use App\Http\Requests\API\JsonRequest;

class StoreFolderRequest extends JsonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
