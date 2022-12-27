<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        // get highest salary of employees
        $employees = Employee::orderByDesc(Department::select('salary_id')->whereColumn('departments.employee_id', 'employees.id')->limit(1))
        // with('departments')

        // $employees = Employee::with('departments');
        // ->dd();
        // dd($employees);
        // $request->highest
        // $employees = Employee::when(
        //     $request->filled('name'),
        //     fn ($query) => $query->where('name', 'like', "%{$request->name}%")
            ->paginate($request->highest);

        return view('welcome', ['employees' => $employees]);
    }

}
