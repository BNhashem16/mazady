<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Salary;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salary = Salary::factory(10)->create();
    }
}
