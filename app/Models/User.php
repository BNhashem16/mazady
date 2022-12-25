<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Transformers\V1\UserTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName(): string
    {
        return is_null($this->name) ? '' : $this->name;
    }

    public function getUsername(): string
    {
        return is_null($this->username) ? '' : $this->username;
    }

    public function getEmail(): string
    {
        return is_null($this->email) ? '' : $this->email;
    }

    public function getToken(): string
    {
        return $this->createToken(env('APP_NAME'))->accessToken;
    }

    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|string|callable
     */
    public function transformer()
    {
        return UserTransformer::class;
    }
}
