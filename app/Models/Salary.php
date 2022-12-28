<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary extends BaseModel
{
    use HasFactory;

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'salary_id');
    }
}
