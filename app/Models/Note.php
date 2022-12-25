<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Note extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public const PUBLIC_TYPE = 'public';
    
    public const PRIVATE_TYPE = 'private';

    public function getType(): string
    {
        return is_null($this->type) ? '' : $this->type;
    }

    public function getContent(): string
    {
        return is_null($this->content) ? '' : $this->content;
    }

    public function getName(): string
    {
        return is_null($this->name) ? '' : $this->name;
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Folder::class, 'id', 'id', 'folder_id', 'user_id');
    }
}
