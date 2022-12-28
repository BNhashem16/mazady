<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getName(): string
    {
        return is_null($this->name) ? '' : $this->name;
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(
            Employee::class,
            'department_employee',
            'department_id',
            'employee_id',
            
        )->withTimestamps();
    }

    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }
}
