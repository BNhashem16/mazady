<?php

namespace App\Http\Requests\API\Folder;

use App\Http\Requests\API\JsonRequest;

class UpdateFolderRequest extends JsonRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            //
        ];
    }
}
