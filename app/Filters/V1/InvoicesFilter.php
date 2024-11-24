<?php

namespace App\Filters\V1;

use App\Filters\ParamFilter;

class InvoicesFilter extends ParamFilter
{
    // Parameters user can use to filter data they need
    protected $safeParams = [
        'customerId' => ['eq', 'ne'],
        'amount' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'status' => ['eq', 'ne'],
        'billedDate' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'paidDate' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
    ];

    // Look up map for the original column name
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];

    // Look up map for the operator the user uses
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];
}

?>
