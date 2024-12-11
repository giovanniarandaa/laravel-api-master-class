<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;

class ApiController extends Controller
{
    use ApiResponses;

    public function include(string $relationship) {
        $param = request()->get('include');

        if (!isset($param)) {
            return false;
        }

        $includeValues = explode(',', strtolower($relationship));
        return in_array(strtolower($relationship), $includeValues);
    }
}
