<?php

namespace App\GraphQL\Types;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class StudentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Student',
        'description' => 'A type that describes a student',
        'model' => Student::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ],
            'age' => [
                'name' => 'age',
                'type' => Type::int()
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::string()
            ],
            'departmentId' => [
                'name' => 'departmentId',
                'type' => Type::int()
            ],
            'department' => [
                'name' => 'department',
                'type' => GraphQL::type('Department')
            ]
        ];
    }
}
