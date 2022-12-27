<?php

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\User  $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->getName(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'token' => $user->getToken(),
        ];
    }
}
