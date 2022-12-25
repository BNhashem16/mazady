<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Models\User;
use App\Transformers\UserTransformer;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        return responder()->success($user, UserTransformer::class)->meta(['message' => 'You are login successfully!'])->respond();
    }
}
