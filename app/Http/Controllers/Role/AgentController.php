<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role == 'agent' ||
                auth()->user()->role == 'super_admin' ||
                auth()->user()->role == 'admin' )
                return $next($request);

            exit('forbidden access');
        });
    }
}
