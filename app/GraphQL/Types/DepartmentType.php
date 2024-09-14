<?php

namespace App\GraphQL\Types;

use App\Models\Department;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DepartmentType extends GraphQLType{
    protected $attributes = [
        'name' => 'Department',
        'description' => 'A type that describes a department',
        'model' => Department::class
    ];

    public function fields(): array{
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'students' => [
                'name' => 'students',
                'type' => Type::listOf(GraphQL::type('Student'))
            ]
        ];
    }
}