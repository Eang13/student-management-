<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@gmail.com']);
        $admin->name = 'Admin';
        $admin->password = 'password123';
        $admin->role = 'admin';
        $admin->save();

        $this->call([DepartmentSeeder::class, StudentSeeder::class]);
    }
}
