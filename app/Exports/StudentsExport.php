<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::select('name', 'email', 'age', 'country', 'departmentId')->get()->map(function ($student){
            return [
                'name' => $student->name,
                'email' => $student->email,
                'age' => $student->age,
                'country' => $student->country,
                'department' => $student->department->name,
            ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Age', 'Country', 'Department'];
    }
}
