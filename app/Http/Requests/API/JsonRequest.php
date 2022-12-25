<?php

namespace App\Http\Requests\API;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

abstract class JsonRequest extends BaseFormRequest
{
    abstract public function authorize(): bool;

    abstract public function rules(): array;

    protected function failedValidation(Validator $validator): ValidationException
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            responder()->error(403, reset($errors)[0])->respond(),
        );
    }

    // protected function failedAuthorization()
    // {
    //     throw new AuthorizationException(
    //         response()->json(['status' => 'Forbidden', 'message' => 'This action is unauthorizedشششششش'], 403)
    //     );
    // }
}
