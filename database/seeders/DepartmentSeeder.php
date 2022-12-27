<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // salaries

        $salary1 = Salary::create([
            'amount' => 500,
        ]);

        $salary2 = Salary::create([
            'amount' => 1000,
        ]);

        $salary3 = Salary::create([
            'amount' => 1500,
        ]);

        $salary4 = Salary::create([
            'amount' => 2000,
        ]);

        $salary5 = Salary::create([
            'amount' => 2500,
        ]);

        $salary6 = Salary::create([
            'amount' => 3000,
        ]);

        $accountingDepartment = Department::factory()->count(1)->create([
            'name' => 'Accounting',
            'salary_id' => $salary1->id,
        ]);

        $managementDepartment = Department::factory()->count(1)->create([
            'name' => 'Management',
            'salary_id' => $salary2->id,
        ]);

        $salesDepartment = Department::factory()->count(1)->create([
            'name' => 'Sales',
            'salary_id' => $salary3->id,
        ]);

        $marketingDepartment = Department::factory()->count(1)->create([
            'name' => 'Marketing',
            'salary_id' => $salary4->id,
        ]);

        $itDepartment = Department::factory()->count(1)->create([
            'name' => 'IT',
            'salary_id' => $salary5->id,
        ]);

        $hrDepartment = Department::factory()->count(1)->create([
            'name' => 'HR',
            'salary_id' => $salary6->id,
        ]);

        // employees
        $employee1 = Employee::factory(1)->create([
            'name' => 'John Doe',
        ]);

        $employee2 = Employee::factory(1)->create();
        $employee3 = Employee::factory(1)->create();
        $employee4 = Employee::factory(1)->create();
        $employee5 = Employee::factory(1)->create();
        $employee6 = Employee::factory(1)->create();
        $employee7 = Employee::factory(1)->create();
        $employee8 = Employee::factory(1)->create();
        

        $accountingDepartment->each(function (Department $department) use ($employee1, $employee2) {
            $department->employees()->attach($employee1);
            $department->employees()->attach($employee2);
        });

        $managementDepartment->each(function (Department $department) use ($employee1, $employee2) {
            $department->employees()->attach($employee1);
            $department->employees()->attach($employee2);
        });

        $salesDepartment->each(function (Department $department) use ($employee3) {
            $department->employees()->attach($employee3);
        });

        $marketingDepartment->each(function (Department $department) use ($employee4, $employee5) {
            $department->employees()->attach($employee4);
            $department->employees()->attach($employee5);
        });
        
        $itDepartment->each(function (Department $department) use ($employee6, $employee7) {
            $department->employees()->attach($employee6);
            $department->employees()->attach($employee7);
        });

        $hrDepartment->each(function (Department $department) use ($employee8, $employee1, $employee2, $employee3, $employee4, $employee5, $employee6, $employee7) {
            $department->employees()->attach($employee6);
            $department->employees()->attach($employee7);
            $department->employees()->attach($employee8);
        });
        

        
        
    }
}
