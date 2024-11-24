<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ParamFilter
{
    /**
     * Allowed parameters user can use to filter data they need.
     */
    protected $safeParams = [];

    /**
     * Look up map for the original column name.
     */
    protected $columnMap = [];

    /**
     * Look up map for the operator the user uses.
     */
    protected $operatorMap = [];

    /**
     * Transform the request parameters into a usable format.
     *
     * @return array
     */
    public function transform(Request $request)
    {
        $eloquentQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            // Set current param
            $query = $request->query($param);

            // Checks if the param is requested by user
            if (!isset($query))
                continue;

            // Get the db name of the column if changed, else just use the current param user request
            $column = $this->columnMap[$param] ?? $param;

            // Loop through the operators the user use in filtering
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    // [columnName, operator, value]
                    $eloquentQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloquentQuery;
    }
}

?>
