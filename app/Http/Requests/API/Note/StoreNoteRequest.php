<?php

namespace App\Http\Requests\API\Note;

use App\Http\Requests\API\JsonRequest;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreNoteRequest extends JsonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'folder_id' => ['required', 'integer', Rule::exists('folders', 'id')->where(function ($query) {
                $query->where('user_id', Auth::id());
            })],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in([Note::PUBLIC_TYPE, Note::PRIVATE_TYPE])],
            'content' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'folder_id.exists' => 'The selected folder does not exist.',
            'type.in' => 'The selected type is invalid, it must be either '.Note::PUBLIC_TYPE.' or '.Note::PRIVATE_TYPE.'.',
        ];
    }
}
