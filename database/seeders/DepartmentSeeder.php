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
        for ($i = 1; $i <= 30; $i++) {
            $salary = 'salary'.$i;
            $$salary = Salary::factory()->create([
                'amount' => $i * 500,
            ]);
        }


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

        $financeDepartment = Department::factory()->count(1)->create([
            'name' => 'Finance',
            'salary_id' => $salary7->id,
        ]);

        $legalDepartment = Department::factory()->count(1)->create([
            'name' => 'Legal',
            'salary_id' => $salary8->id,
        ]);

        $customerServiceDepartment = Department::factory()->count(1)->create([
            'name' => 'Customer Service',
            'salary_id' => $salary9->id,
        ]);

        $operationsDepartment = Department::factory()->count(1)->create([
            'name' => 'Operations',
            'salary_id' => $salary10->id,
        ]);

        $researchAndDevelopmentDepartment = Department::factory()->count(1)->create([
            'name' => 'Research and Development',
            'salary_id' => $salary11->id,
        ]);

        for ($i = 1; $i <= 100; $i++) {
            $employee = 'employee'.$i;
            $$employee = Employee::factory()->create([
                'name' => 'Employee '.$i,
            ]);
        }

        $accountingDepartment->each(function (Department $department) use ($employee1, $employee2, $employee8, $employee20, $employee40) {
            $department->employees()->attach($employee1);
            $department->employees()->attach($employee2);
            $department->employees()->attach($employee8);
            $department->employees()->attach($employee20);
            $department->employees()->attach($employee40);
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

        $financeDepartment->each(function (Department $department) use ($employee9, $employee10, $employee11, $employee12, $employee13, $employee18, $employee19, $employee20) {
            $department->employees()->attach($employee9);
            $department->employees()->attach($employee10);
            $department->employees()->attach($employee11);
            $department->employees()->attach($employee12);
            $department->employees()->attach($employee13);
            $department->employees()->attach($employee18);
            $department->employees()->attach($employee19);
            $department->employees()->attach($employee20);
        });
    }
}
