<?php

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class StudentsQuery extends Query
{
    protected $attributes = [
        'name' => 'students',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Student'));
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        // if (isset($args['id'])) {
        //     return Student::where('id', $args['id'])->get();
        // }
        // if (isset($args['name'])) {
        //     return Student::where('name', $args['name'])->get();
        // }
        // if (isset($args['email'])) {
        //     return Student::where('email', $args['email'])->get();
        // }
        // if (isset($args['age'])) {
        //     return Student::where('age', $args['age'])->get();
        // }
        // if (isset($args['country'])) {
        //     return Student::where('country', $args['country'])->get();
        // }

        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        return Student::select($select)->with($with)->get();
    }
}
