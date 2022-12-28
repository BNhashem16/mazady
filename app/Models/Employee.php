<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

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
        return $this->belongsToMany(Department::class)->withTimestamps();
    }

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

    // salaries relation through departments
    public function salaries(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_employee', 'department_id', 'employee_id')->withTimestamps();
    }

}
