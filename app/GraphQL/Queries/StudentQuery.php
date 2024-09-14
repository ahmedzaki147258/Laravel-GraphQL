<?php

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class StudentQuery extends Query
{
    protected $attributes = [
        'name' => 'student',
    ];

    public function type(): Type
    {
        return GraphQL::type('Student');
    }

    public function args() : array {
        return [
            'id' => [
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields){
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        return Student::select($select)->with($with)->find($args['id']);
    }
}