<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee1 = Employee::create([
            'firstname' => 'Kevin',
            'lastname' => 'Treminio'
        ]);

        $employee2 = Employee::create([
            'firstname' => 'Juan',
            'lastname' => 'López'
        ]);
    }
}
