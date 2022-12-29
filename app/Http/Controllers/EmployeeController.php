<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Department;
use App\Models\Salary;
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

    // public function show(FilterRequest $request)
    // {
    //     is_null($request->highest) ? $highest = 0 : $highest = $request->highest;
    //     $employeesData = [];

    //     $salaries = Salary::orderByDesc('amount')->get();
    //     $salaries->each(function ($salary, $salaryKey) use (&$employeesData) {
    //         // dd($salary);

    //         $salary->departments
    //             ->each(function ($department, $departmentKey) use (&$employeesData, &$salaryKey, &$salary) {
    //                 // dd($department);

    //                 $department->employees->each(function ($employee, $employeeKey) use (&$salaryKey, &$departmentKey, &$employeesData, &$salary, &$department) {
    //                     $employeesData[$salaryKey][$departmentKey][$employeeKey]['employee'] = $employee->name;
    //                     $employeesData[$salaryKey][$departmentKey][$employeeKey]['employee_id'] = $employee->id;
    //                     $employeesData[$salaryKey][$departmentKey][$employeeKey]['salary_id'] = $salary->id;
    //                     $employeesData[$salaryKey][$departmentKey][$employeeKey]['amount'] = $salary->amount;
    //                     $employeesData[$salaryKey][$departmentKey][$employeeKey]['department'] = $department->name;
    //                     $employeesData[$salaryKey][$departmentKey][$employeeKey]['department_id'] = $department->id;
    //                 });
    //             });
    //     });

    //     $employees = collect(Arr::flatten($employeesData, 2));
    //     $counter = 1;
    //     $loopCounter = 1;
    //     $employees->each(function ($employee, $employeeKey) use (&$counter, &$employees, &$loopCounter, &$request) {

    //         if ($employeeKey > 0 && $counter < $request->highest) {
    //             if ($employee['salary_id'] == $employees[$employeeKey - 1]['salary_id']) {
    //                 $loopCounter++;
    //             } else {
    //                 $counter++;
    //                 $loopCounter++;
    //             }
    //         }
    //     });

    //     $employees = $employees->filter(function ($employee, $employeeKey) use (&$loopCounter, &$counter) {
    //         return $employeeKey <= $loopCounter;
    //     })->all();

    //     return view('employees', ['employees' => $employees]);
    // }

    public function show(FilterRequest $request)
    {
        is_null($request->highest) ? $highest = 0 : $highest = $request->highest - 1;
        $employeesData = [];

        $salary = Salary::orderByDesc('amount')->offset($highest)->first();
        $departments = Department::where('salary_id', $salary->id)->get();
        
        $departments->each(function ($department, $departmentKey) use (&$employeesData, &$salaryKey, &$salary) {
            $department->employees->each(function ($employee, $employeeKey) use (&$salaryKey, &$departmentKey, &$employeesData, &$salary, &$department) {
                $employeesData[$salaryKey][$departmentKey][$employeeKey]['employee'] = $employee->name;
                $employeesData[$salaryKey][$departmentKey][$employeeKey]['employee_id'] = $employee->id;
                $employeesData[$salaryKey][$departmentKey][$employeeKey]['salary_id'] = $salary->id;
                $employeesData[$salaryKey][$departmentKey][$employeeKey]['amount'] = $salary->amount;
                $employeesData[$salaryKey][$departmentKey][$employeeKey]['department'] = $department->name;
                $employeesData[$salaryKey][$departmentKey][$employeeKey]['department_id'] = $department->id;
            });
        });

        $employees = collect(Arr::flatten($employeesData, 2));

        return view('employees', ['employees' => $employees]);
    }
}
