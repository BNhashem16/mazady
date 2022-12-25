<?php

namespace Database\Seeders;

use App\Models\Department;
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
        $departments = Department::factory(5)->create();
        $departments->each(function (Department $department) {
            $department->employees()->attach($department->inRandomOrder()->limit(5)->get());
        });
    }
}
