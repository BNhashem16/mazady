<?php

namespace Tests\Feature;

use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fifth_heighest_employees()
    {
        $response = $this->get('/employees?highest=5');
        $response->assertSee('11000');
        $response->assertStatus(200);
    }

    public function test_sixth_heighest_employees()
    {
        $response = $this->get('/employees?highest=6');
        $response->assertSee('10500');
        $response->assertStatus(200);
    }

    public function test_seventh_heighest_employees()
    {
        $response = $this->get('/employees?highest=7');
        $response->assertSee('10000');
        $response->assertStatus(200);
    }

    public function test_count_of_heighest_three_employees_with_wrong_parameter()
    {
        $response = $this->get('/employees?highest=55');
        $response->assertStatus(302); // 302 is the status code for redirect () in FilterRequest.php
    }

    public function test_count_of_heighest_three_employees_with_no_parameter()
    {
        $response = $this->get('/employees');
        $response->assertStatus(200);
        $response->assertSee('13000'); // 13000 is the highest salary
    }

    public function test_count_of_heighest_three_employees_with_wrong_parameter_type()
    {
        $response = $this->get('/employees?highest=text');
        $response->assertStatus(302); // 302 is the status code for redirect () in FilterRequest.php
    }
}
