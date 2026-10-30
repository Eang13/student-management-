<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['dept_name' => 'Management Information System', 'manager_id' => 1, 'location_id' => 1],
            ['dept_name' => 'Design',                        'manager_id' => 2, 'location_id' => 2],
            ['dept_name' => 'Networking',                    'manager_id' => 3, 'location_id' => 3],
        ] as $d) {
            Department::updateOrCreate(['dept_name' => $d['dept_name']], $d);
        }
    }
}
