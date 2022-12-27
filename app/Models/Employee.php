<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    public function getName(): string
    {
        return is_null($this->name) ? '' : $this->name;
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class)->withTimestamps()->using(Salary::class)->withPivot('department_id');
    }

    // get all departments of employee ordered by amount
    public function getDepartmentsOrderedByAmount(): Collection
    {
        return $this->departments()->get()->groupBy('salary_id')->flatten(1);
    }

    public function getSalaries(): Collection
    {
        return $this->departments()->get()->map(fn ($department) => $department->salary->amount);
    }

    public function getHighestSalary(): int
    {
        return $this->getSalaries()->max();
    }
}
