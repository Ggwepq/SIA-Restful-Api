<?php

namespace App\Filters\V1;

use App\Filters\ParamFilter;

class CustomersFilter extends ParamFilter
{
    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'type' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'address' => ['eq', 'ne'],
        'city' => ['eq', 'ne'],
        'state' => ['eq', 'ne'],
        'postalCode' => ['eq', 'gt', 'lt', 'ne'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}

?>
