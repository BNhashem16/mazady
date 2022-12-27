<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Service\Arr;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        is_null($request->highest) ? $highest = 1 : $highest = $request->highest;
        $data = [];
        $departments = Department::select('departments.name', 'departments.id', 'salaries.amount')
            ->join('salaries', 'salaries.id', '=', 'departments.salary_id')->orderByDesc('salaries.amount')->get();

        $departments->each(function ($department, $key) use (&$data) {
            $department->employees->each(function ($employee, $employeeKey) use (&$data, $key, $department) {
                $data[$employeeKey][$key]['employee'] = $employee->name;
                $data[$employeeKey][$key]['department'] = $department->name;
                $data[$employeeKey][$key]['amount'] = $department->amount;
            });
        });

        $data = collect(Arr::flatten($data, 1))->unique('employee')->values()->sortByDesc(
            fn ($item) => $item['amount']
        )->all();

        $employees = Arr::paginate($data, $highest);

        return view('welcome', ['employees' => $employees]);
    }
}
