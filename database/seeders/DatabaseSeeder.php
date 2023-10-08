<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Employee;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Position;
use App\Models\Responsibility;
use App\Models\Role;
use App\Models\Student;
use App\Models\Student_Class;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Employee::factory(20)->create();
        Position::factory(10)->create();
        Kelas::factory(20)->create();
        Course::factory(30)->create();
        Role::factory(20)->create();
        Responsibility::factory(100)->create();
        Nilai::factory(50)->create();
        Student::factory(10)->create();
        Student_Class::factory(50)->create();
    }
}
