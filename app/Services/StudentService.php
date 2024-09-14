<?php

namespace App\Services;

use App\Models\Student;
use App\Events\StudentCreated;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class StudentService
{
    public function createStudent($data){
        $student = Student::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'country' => $data['country'],
            'departmentId' => $data['departmentId'],
        ]);
        event(new StudentCreated($student));
        return $student;
    }
}