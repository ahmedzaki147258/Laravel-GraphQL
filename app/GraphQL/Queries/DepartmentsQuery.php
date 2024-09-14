<?php

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Department;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DepartmentsQuery extends Query
{
    protected $attributes = [
        'name' => 'departments',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Department'));
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        return Department::select($select)->with($with)->get();
    }
}
