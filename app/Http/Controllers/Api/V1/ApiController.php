<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    use ApiResponses;

    protected string $policyClass;

    public function __construct() {
        Gate::guessPolicyNamesUsing(function () {
            return $this->policyClass;
        });
    }

    public function include(string $relationship) {
        $param = request()->get('include');

        if (!isset($param)) {
            return false;
        }

        $includeValues = explode(',', strtolower($relationship));
        return in_array(strtolower($relationship), $includeValues);
    }
}
