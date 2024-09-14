<?php

namespace App\GraphQL\Mutations;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateStudentMutation extends Mutation {
    protected $attributes = [
        'name' => 'createStudent',
    ];

    public function type(): Type{
        return GraphQL::type('Student');
    }

    public function args(): array{
        return [
            'name' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'email' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'age' => [
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'country' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'departmentId' => [
                'type' => Type::int(),
                'rules' => ['required', 'exists:departments,id']
            ],
        ];
    }

    public function resolve($root, $args){
        $student = new Student();
        $student->name = $args['name'];
        $student->email = $args['email'];
        $student->age = $args['age'];
        $student->country = $args['country'];
        $student->departmentId = $args['departmentId'];
        $student->save();
        return $student;
    }
}