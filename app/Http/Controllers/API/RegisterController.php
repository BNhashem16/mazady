<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $inputs = $request->validatedExcept(['password_confirmation, password']);
        $inputs['password'] = Hash::make($inputs['password']);
        $user = User::create($inputs);

        return responder()->success($user, UserTransformer::class)->meta(['message' => 'You are login successfully!'])->respond(201);
    }
}
