<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            ['name' => 'Computer Sciences'],
            ['name' => 'Information Systems'],
            ['name' => 'Scientific Computing'],
            ['name' => 'Computer Systems'],
        ]);
    }
}
