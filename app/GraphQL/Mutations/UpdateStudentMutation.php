<?php

namespace App\GraphQL\Mutations;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateStudentMutation extends Mutation {
    protected $attributes = [
        'name' => 'updateStudent',
    ];

    public function type(): Type{
        return GraphQL::type('Student');
    }

    public function args(): array{
        return [
            'id' => [
                'type' => Type::int()
            ],
            'name' => [
                'type' => Type::string()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'age' => [
                'type' => Type::int()
            ],
            'country' => [
                'type' => Type::string()
            ],
            'departmentId' => [
                'type' => Type::int(),
                'rules' => ['exists:departments,id']
            ],
        ];
    }

    public function resolve($root, $args){
        $student = Student::find($args['id']);
        $student->fill($args);
        $student->save();
        return $student;
    }
}