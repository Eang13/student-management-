<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $mis    = Department::where('dept_name', 'Management Information System')->value('dept_id');
        $design = Department::where('dept_name', 'Design')->value('dept_id');

        foreach ([
            ['Kong Sopheak', 'kongsopheak@gmail.com', 'Male',   '2022-01-01', null, $mis],
            ['Ly Chhailin',  'lin@gmail.com',         'Female', '2022-01-01', null, $design],
            ['Pov Nita',     'povnita@gmail.com',     'Female', '2023-04-11', 'OK', $mis],
            ['Leng Makara',  'lengmakara@gmail.com',  'Male',   '2024-11-01', null, $design],
        ] as [$name, $email, $gender, $date, $desc, $dept]) {
            Student::updateOrCreate(['email' => $email], [
                'student_name' => $name, 'gender' => $gender,
                'enrollment_date' => $date, 'description' => $desc,
                'department_id' => $dept,
            ]);
        }
    }
}
