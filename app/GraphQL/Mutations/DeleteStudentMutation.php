<?php

namespace App\GraphQL\Mutations;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteStudentMutation extends Mutation{
    protected $attributes = [
        'name' => 'deleteStudent'
    ];

    public function type(): Type{
        return GraphQL::type('Student');
    }

    public function args(): array{
        return [
            'id' => [
                'type' => Type::int()
            ],
        ];
    }

    public function resolve($root, $args){
        $student = Student::find($args['id']);
        $student->delete();
        return $student;
    }
}