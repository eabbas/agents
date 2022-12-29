<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role == 'super_admin')
                return $next($request);

            exit('forbidden access');
        });
    }
}
